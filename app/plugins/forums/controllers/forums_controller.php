  <?php
 class ForumsController extends ForumsAppController
 {
 	var $name = 'Forums';
 	var $uses = array("Forums.ForumCategory", "Forums.ForumThread", "Forum.ForumPost");
	var $helpers = array("Bbcode");
	/**
 	 * @var SessionComponent
 	 */
 	var $Session;
 	 /**
 	 * @var AclComponent
 	 */
 	var $Acl;
 	 /**
 	 * @var AuthComponent
 	 */
 	var $Auth;

 	var $paginate = array('ForumPost' =>
 							array(
 								'contain' => array('User'),
 								'limit' => 20
 							),
 							'ForumThread' =>
 							array(
 								'contain' => array('User'),
 								'limit' => 20
 							));

	function index($slug = null)
	{
		$this->set('categories', $this->ForumCategory->fetchCategories($slug, $this->Auth->user('id')));
		if ($slug != null)
			$this->set('category', $this->ForumCategory->findBySlug($slug));
	}

	function forum($slug = null)
	{
		if ($slug != null)
		{
			$this->ForumCategory->ForumForum->recursive = -1;
			$forum = $this->ForumCategory->ForumForum->findBySlug($slug);
			$this->paginate = array('ForumThread' =>
 							array(
 								'contain' => array('User',
													'ForumPost' => array('User', 'order' => 'ForumPost.created DESC', 'limit' => 1),
 													'ForumUnreadPost' => array('conditions' => array('ForumUnreadPost.user_id' => $this->Auth->user('id'))))
 						));


			$this->set('breadcrumbs', $this->ForumCategory->ForumForum->fetchBreadcrumbs($slug));
			$this->set('threads', $this->paginate('ForumThread', array('ForumThread.forum_forum_id' => $forum['ForumForum']['id'])));
			$this->set('subForums', $this->ForumCategory->ForumForum->fetchSubForums($slug, $this->Auth->user('id')));
			$this->set('forum', $forum);
		}
		else
		{
			$this->redirect(array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'index'));
		}
	}

	function thread($slug = null, $post = null)
	{
		if ($slug != null)
		{
			$this->ForumThread->recursive = -1;
			$thread = $this->ForumThread->findBySlug($slug);

			$this->ForumThread->id = $thread['ForumThread']['id'];
			$this->ForumThread->saveField('views', $thread['ForumThread']['views'] + 1);
			$this->ForumThread->ForumUnreadPost->deleteAll(array('ForumUnreadPost.forum_thread_id' => $thread['ForumThread']['id'], 'ForumUnreadPost.user_id' => $this->Auth->user('id')));
			$this->ForumThread->ForumSubscriber->updateAll(array('ForumSubscriber.active' => 1), array('ForumSubscriber.user_id' => $this->Auth->user('id'), 'ForumSubscriber.forum_thread_id' => $thread['ForumThread']['id']));

			if ($post != null)
			{
  				$this->paginate['ForumPost']['page'] = $this->ForumPost->getPageNumber($post, $this->paginate['ForumPost']['limit']);
			}

			$this->set('breadcrumbs', $this->ForumThread->fetchBreadcrumbs($slug));
			$this->set('posts', $this->paginate('ForumPost', array('ForumPost.forum_thread_id' => $thread['ForumThread']['id'])));
			$this->set('thread', $thread);
			$this->set('subscribed', $this->ForumThread->ForumSubscriber->find('count', array('contain' => false, 'conditions' => array('ForumSubscriber.user_id' => $this->Auth->user('id'), 'ForumSubscriber.forum_thread_id' => $thread['ForumThread']['id']))));
		}
		else
		{
			$this->redirect(array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'index'));
		}
	}

	function newTopic($forumSlug = null)
	{
		if ($forumSlug != null)
		{
			$forum =  $this->ForumCategory->ForumForum->findBySlug($forumSlug);

			if (isset($this->data))
			{
				$this->data['ForumPost'][0]['title'] = $this->data['ForumThread']['title'];
				$this->data['ForumPost'][0]['text'] = $this->data['ForumThread']['post'];
				$this->data['ForumPost'][0]['tags'] = $this->data['ForumThread']['tags'];
				$this->data['ForumPost'][0]['user_id'] = $this->Auth->user('id');
				$this->data['ForumThread']['user_id'] = $this->Auth->user('id');
				$this->data['ForumThread']['forum_forum_id'] = $forum['ForumForum']['id'];

				if ($this->ForumThread->saveAll($this->data))
				{
					$thread = $this->ForumThread->read();

					$this->redirect(array('action' => 'thread', $thread['ForumThread']['slug']));
				}
			}
			else
			{
				$this->set(compact('forumSlug'));
				$this->set('breadcrumbs', $this->ForumCategory->ForumForum->fetchBreadcrumbs($forumSlug));
				$this->set('forum',$forum);
			}
		}
		else
		{
			$this->redirect(array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'index'));
		}
	}

	function reply($threadSlug = null)
	{
		if ($threadSlug != null && isset($this->data))
		{
			$thread = $this->ForumThread->findBySlug($threadSlug);

			$this->data['ForumPost']['forum_thread_id'] = $thread['ForumThread']['id'];
			$this->data['ForumPost']['user_id'] = $this->Auth->user('id');

			if ($this->ForumPost->save($this->data))
			{
				$post = $this->ForumPost->find('first', array('contain' => array('ForumThread' => array('ForumForum'), 'User'), 'conditions' => array('ForumPost.id' => $this->ForumPost->id)));
				if ($this->data['ForumPost']['subscribe'])
				{
					if (!$this->ForumThread->ForumSubscriber->find('count', array('contain' => false, 'conditions' => array('ForumSubscriber.user_id' => $this->Auth->user('id'), 'ForumSubscriber.forum_thread_id' => $thread['ForumThread']['id']))))
					{
						$subscribe['ForumSubscriber']['user_id'] = $this->Auth->user('id');
						$subscribe['ForumSubscriber']['forum_thread_id'] = $thread['ForumThread']['id'];
						$subscribe['ForumSubscriber']['active'] = 1;
						$this->ForumThread->ForumSubscriber->save($subscribe);
					}
					else
					{
						$this->ForumThread->ForumSubscriber->updateAll(array('ForumSubscriber.active' => 1), array('ForumSubscriber.user_id' => $this->Auth->user('id'), 'ForumSubscriber.forum_thread_id' => $thread['ForumThread']['id']));
					}
				}
				else
				{
					if ($this->ForumThread->ForumSubscriber->find('count', array('contain' => false, 'conditions' => array('ForumSubscriber.user_id' => $this->Auth->user('id'), 'ForumSubscriber.forum_thread_id' => $thread['ForumThread']['id']))))
					{
						$this->ForumThread->ForumSubscriber->deleteAll(array('ForumSubscriber.user_id' => $this->Auth->user('id'), 'ForumSubscriber.forum_thread_id' => $thread['ForumThread']['id']));
					}
				}

				$users = $this->ForumThread->User->find('all', array('contain' => false, 'fields' => array('id'), 'conditions' => array('User.id <>' => $this->Auth->user('id'))));
				$unreads = array();
				foreach ($users as $user)
				{
					if ($this->ForumThread->ForumUnreadPost->find('count', array('conditions' => array('ForumUnreadPost.user_id' => $user['User']['id'], 'ForumUnreadPost.forum_thread_id' => $thread['ForumThread']['id']))) == 0)
						$unreads[]['ForumUnreadPost'] = array('user_id' => $user['User']['id'], 'forum_thread_id' => $thread['ForumThread']['id']);
				}
				$this->ForumThread->ForumUnreadPost->saveAll($unreads);

				$this->ForumThread->ForumSubscriber->displayField = 'user_id';
				$subscribedUsers = $this->ForumThread->ForumSubscriber->find('list', array('contain' => false, 'conditions' => array('ForumSubscriber.active' => 1, 'ForumSubscriber.user_id <>' => $this->Auth->user('id'), 'ForumSubscriber.forum_thread_id' => $thread['ForumThread']['id'])));

				$this->Notification->sendNotification('thread_reply', $post, true, array_values($subscribedUsers));

				$this->ForumThread->ForumSubscriber->updateAll(array('ForumSubscriber.active' => 0), array('ForumSubscriber.user_id <>' => $this->Auth->user('id'), 'ForumSubscriber.forum_thread_id' => $thread['ForumThread']['id']));

				$this->redirect(array('action' => 'thread', $threadSlug, $this->ForumPost->id, '#' => $this->ForumPost->id));
			}
		}
		elseif ($threadSlug != null && !isset($this->data))
		{

		}
		else
		{

		}
	}

 	function autoTag()
	{
		App::import('Component', 'Keywords');
		$keywords = new KeywordsComponent();

		echo $keywords->keywordIt($this->params['form']['text']);

		exit;
	}

 }
?>