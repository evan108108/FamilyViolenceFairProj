<tr id="pollchoice-<?php echo $id ?>">
  <td class="weight">
    <?php echo CHtml::activeDropDownList($choice,"[$id]weight",$choice->weights); ?>
    <?php echo CHtml::error($choice,"[$id]weight"); ?>
  </td>
  <td class="label">
    <?php echo CHtml::activeTextField($choice,"[$id]label",array('size'=>60,'maxlength'=>255)); ?>
    <?php echo CHtml::error($choice,"[$id]label"); ?>
    <div class="errorMessage" style="display:none">You must enter a label.</div>
  </td>
  <td class="actions">
  <?php
    $deleteJs = 'jQuery("#pollchoice-'. $id .'").find("td").fadeOut(1000,function(){jQuery(this).parent().remove();});return false;';

    if (isset($choice->id)) {
      // Add AJAX delete link
      echo CHtml::ajaxLink(
        'Delete',
        array('/poll/pollchoice/delete', 'id' => $choice->id, 'ajax' => TRUE),
        array('type' => 'POST', 'success' => 'js:function(){'. $deleteJs .'}'),
        array('confirm' => 'Are you sure you want to delete this item?')
      );
    }
    else {
      // Model hasn't been created yet, so just remove the DOM element
      echo CHtml::link('Delete', '#', array('onclick' => 'js:'. $deleteJs));
    }
    // Add additional hidden fields
    echo CHtml::activeHiddenField($choice,"[$id]id");
  ?>
  </td>
</tr>
