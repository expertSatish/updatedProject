function ProductStatus(Id,Status){
    $.ajax({
        data:{_token:XCSRF_Token,product:Id,status:Status},
        url:ProductStatusUrl,
        method:'POST',
        dataType:'JSON',
        cache:false,
        success:function(data){
            $('.statusbox'+Id).html(data.button);
            toastr.options.positionClass = 'toast-bottom-right';
            toastr.success(data.message);
        }   
    });
}
function ProductFeatured(Id,Status){
    $.ajax({
        data:{_token:XCSRF_Token,product:Id,status:Status},
        url:ProductFeaturedUrl,
        method:'POST',
        dataType:'JSON',
        cache:false,
        success:function(data){
            $('.featuredstatusbox'+Id).html(data.button);
            toastr.options.positionClass = 'toast-bottom-right';
            toastr.success(data.message);
        }   
    });
}
function ProductRemoved(Id){
    if(confirm("Are you sure! You want to remove this record.")){
        $.ajax({
            data:{_token:XCSRF_Token,product:Id},
            url:ProductRemovedUrl,
            method:'POST',
            dataType:'JSON',
            cache:false,
            success:function(data){
                $('.row'+Id).remove();
                toastr.options.positionClass = 'toast-bottom-right';
                toastr.success(data.message);
            }   
        });
    }
}
function CompanyFactoryRemoved(Id){
    if(confirm("Are you sure! You want to remove this record.")){
        $.ajax({
            data:{_token:XCSRF_Token,factory:Id},
            url:FactoryRemovedUrl,
            method:'POST',
            dataType:'JSON',
            cache:false,
            success:function(data){
                $('.frow'+Id).remove();
                toastr.options.positionClass = 'toast-bottom-right';
                toastr.success(data.message);
            }   
        });
    }
}
function LoadMoreProduct(Id,company,listno){
    $.ajax({
        data:{_token:XCSRF_Token,product:Id,company:company,listno:listno},
        url:ProductLoadUrl,
        method:'POST',
        dataType:'JSON',
        cache:false,
        success:function(data){
            $('.row'+Id).after(data.html);
            $('.morebtn').html(data.button);
            toastr.options.positionClass = 'toast-bottom-right';
            toastr.error(data.message);
        }   
    });
}