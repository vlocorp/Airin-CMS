<!-- SCRIPT CHAIN DROPDOWNLIST RELATED -->
<script>
    function chainDropDown(){
        var category_id = $('#category_id').val();            
        $("#sub_category_id > option").remove();
            
        $.ajax({
            url:"<?php echo $this->createAbsoluteUrl('post/GetSubCategoryOptions'); ?>",
            data:'category_id='+category_id,
            type:'post',
            dataType:'json',
            success:function(data){
                $.each(data,function(id,name) 
                {
                    var opt = $('<option />');
                    opt.val(id);
                    opt.text(name);
                    $('#sub_category_id').append(opt);                                        
                });
            }
        })
    }
    
    $(function(){           
        chainDropDown();
        
        $('#category_id').change(function(){
            chainDropDown();
        })
    })
</script>
