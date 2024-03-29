<?php
/**
 * BootTabbable class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

//Yii::import('bootstrap.widgets.BootMenu');
//Yii::import('bootstrap.widgets.BootWidget');

/**
 * Bootstrap JavaScript tabs widget.
 * @since 0.9.8
 * @todo Fix event support. http://twitter.github.com/bootstrap/javascript.html#tabs
 */
class BootTabbable extends BootWidget
{
	// Tab placements.
	const PLACEMENT_ABOVE = 'above';
	const PLACEMENT_BELOW = 'below';
	const PLACEMENT_LEFT = 'left';
	const PLACEMENT_RIGHT = 'right';

	/**
	 * @var string the type of tabs to display. Defaults to 'tabs'.
	 * Valid values are 'tabs' and 'pills'.
	 * Please not that JavaScript pills are not fully supported in Bootstrap!
	 */
    public $type = BootMenu::TYPE_TABS;
	/**
	 * @var string the placement of the tabs.
	 * Valid values are 'above', 'below', 'left' and 'right'.
	 */
	public $placement = self::PLACEMENT_ABOVE;
	/**
	 * @var array the tab configuration.
	 */
    public $tabs = array();
	/**
	 * @var boolean whether to encode item labels.
	 */
	public $encodeLabel = true;

    /**
     * Initializes the widget.
     */
    public function init()
    {
		if (!isset($this->htmlOptions['id']))
			$this->htmlOptions['id'] = $this->getId();

		if (isset($this->placement))
		{
			$validPlacements = array(self::PLACEMENT_ABOVE, self::PLACEMENT_BELOW, self::PLACEMENT_LEFT, self::PLACEMENT_RIGHT);
			if (in_array($this->placement, $validPlacements))
			{
				$cssClass = 'tabs-'.$this->placement;
				if (isset($this->htmlOptions['class']))
					$this->htmlOptions['class'] .= ' '.$cssClass;
				else
					$this->htmlOptions['class'] = $cssClass;
			}
		}

		Yii::app()->bootstrap->registerTabs();
    }

    /**
     * Run this widget.
     */
    public function run()
    {
	    $id = $this->id;
	    $content = array();
	    $items = $this->normalizeTabs($this->tabs, $content);

		ob_start();
		$this->controller->widget('bootstrap.widgets.BootMenu', array(
			'type'=>$this->type,
			'encodeLabel'=>$this->encodeLabel,
			'items'=>$items,
		));
		$tabs = ob_get_clean();

		ob_start();
		echo '<div class="tab-content">';
		echo implode('', $content);
		echo '</div>';
		$content = ob_get_clean();

		echo CHtml::openTag('div', $this->htmlOptions);
		echo $this->placement === self::PLACEMENT_BELOW ? $content.$tabs : $tabs.$content;
		echo '</div>';

	    /** @var CClientScript $cs */
	    $cs = Yii::app()->getClientScript();
	    $cs->registerScript(__CLASS__.'#'.$id, "jQuery('#{$id}').tab('show');");

        // Register the "show" event-handler.
        if (isset($this->events['show']))
        {
            $fn = CJavaScript::encode($this->events['show']);
	        $cs->registerScript(__CLASS__.'#'.$id.'.show',
	                "jQuery('#{$id} a[data-toggle=\"tab\"').on('show', {$fn});");
        }

        // Register the "shown" event-handler.
        if (isset($this->events['shown']))
        {
            $fn = CJavaScript::encode($this->events['shown']);
	        $cs->registerScript(__CLASS__.'#'.$id.'.shown',
	                "jQuery('#{$id} a[data-toggle=\"tab\"').on('shown', {$fn});");
        }
    }

	/**
	 * Normalizes the tab configuration.
	 * @param array $tabs the tab configuration
	 * @param array $panes a reference to the panes array
	 * @param integer $i the current index
	 * @return array the items
	 */
	protected function normalizeTabs($tabs, &$panes, &$i = 0)
	{
		$id = $this->getId();
		$transitions = Yii::app()->bootstrap->isPluginRegistered(Bootstrap::PLUGIN_TRANSITION);

		$items = array();

	    foreach ($tabs as $tab)
	    {
			$item = $tab;

			if (!isset($item['itemOptions']))
				$item['itemOptions'] = array();

		    if ($i === 0)
		    {
			    if (isset($item['itemOptions']['class']))
	                $item['itemOptions']['class'] .= ' active';
	            else
		            $item['itemOptions']['class'] = 'active';
		    }

			$item['linkOptions']['data-toggle'] = 'tab';

		    if (isset($tab['items']))
				$item['items'] = $this->normalizeTabs($item['items'], $panes, $i);
			else
			{
				if (!isset($item['id']))
					$item['id'] = $id.'_tab_'.++$i;

				$item['url'] = '#'.$item['id'];

				if (!isset($item['content']))
					$item['content'] = '';

				$content = $item['content'];
				unset($item['content']);

				if (!isset($item['paneOptions']))
					$item['paneOptions'] = array();

				$paneOptions = $item['paneOptions'];
				unset($item['paneOptions']);

				$paneOptions['id'] = $item['id'];

				if (isset($tab['paneOptions']['class']))
					$paneOptions['class'] .= ' tab-pane';
				else
					$paneOptions['class'] = 'tab-pane';

				if ($transitions)
					$paneOptions['class'] .= ' fade';

				if ($i === 1)
				{
					if ($transitions)
						$paneOptions['class'] .= ' in';

					$paneOptions['class'] .= ' active';
				}

				$panes[] = CHtml::tag('div', $paneOptions, $content);
			}

			$items[] = $item;
	    }

		return $items;
	}
}
