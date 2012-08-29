<!-- SCRIPT CHAIN DROPDOWNLIST RELATED -->
<script>
    function chainDropDown(){
        var parentId = $('#<?php echo $parentId;?>').val();            
        $("#<?php echo $childId;?> > option").remove();
            
        $.ajax({
            url:"<?php echo Yii::app()->createAbsoluteUrl($url); ?>",
            data:'<?php echo $parentId;?>='+parentId,
            type:'post',
            dataType:'json',
            success:function(data){
                $.each(data,function(<?php echo $valueField;?>,<?php echo $textField;?>) 
                {
                    var opt = $('<option />');
                    opt.val(<?php echo $valueField;?>);
                    opt.text(<?php echo $textField;?>);
                    $('#<?php echo $childId;?>').append(opt);                                        
                });
            }
        })
    }
    
    $(function(){           
        chainDropDown();
        
        $('#<?php echo $parentId;?>').change(function(){
            chainDropDown();
        })
    })
</script>
