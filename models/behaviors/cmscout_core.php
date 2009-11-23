<?php
class CmscoutCoreBehavior extends ModelBehavior
{
 	function flushMenuCache()
 	{
 		Cache::delete('menu', 'core');
 	}
}