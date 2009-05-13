<?php
    /*
     *  @author: Suhail Doshi
     */

	function tagCloudcmp($a, $b)
	{
		if ($a['count'] == $b['count'])
		{
			return 0;
		}
		return ($a['count'] > $b['count']) ? -1 : 1;
	}

    class TagcloudHelper extends Helper
    {

        /*
         *  @param array $dataSet Example: array('name' => 100, 'name2' => 200)
         *
         *  returns associative array.
         */
        function formulateTagCloud($dataSet, $sorted = true) {
        	usort($dataSet, 'tagCloudcmp'); // Sort array accordingly.

            // Retrieve extreme score values for normalization
            $minimumScore = min($dataSet);
            $maximumScore = max($dataSet);

            // Populate new data array, with score value and size.
            $data = array();
            foreach ($dataSet as $tag)
            {
                $tag['size'] = $this->_getPercentSize($maximumScore['count'], $minimumScore['count'], $tag['count']);
                $data[] = $tag;
            }

            if ($sorted == true)
            	return $data;
            else
            	return $this->__shuffleTags($data);
        }

        /*
         *  @param int $maxValue Maximum score value in array.
         *  @param int $minValue Minimum score value in array.
         *  @param int $currentValue Current score value for given item.
         *  @param int [$minSize] Minimum font-size.
         *  @param int [$maxSize] Maximum font-size.
         *
         *  returns int percentage for current tag.
         */
        function _getPercentSize($maximumScore, $minimumScore, $currentValue, $minSize = 70, $maxSize = 200) {
            if ($minimumScore < 1) $minimumScore = 1;
            $spread = $maximumScore - $minimumScore;
            if ($spread == 0) $spread = 1;
            // determine the font-size increment, this is the increase per tag quantity (times used)
            $step = ($maxSize - $minSize) / $spread;
            // Determine size based on current value and step-size.
            $size = $minSize + (($currentValue - $minimumScore) * $step);
            return $size;
        }

        /*
         *  @param array $tags An array of tags (takes an associative array)
         *
         *  returns shuffled array of tags for randomness.
         */
    function __shuffleTags ($tags) {
        while (count($tags) > 0) {
            $val = array_rand($tags);
            $new_arr[$val] = $tags[$val];
            unset($tags[$val]);
        }
        if (isset($new_arr))
            return $new_arr;
    }
 }
?>