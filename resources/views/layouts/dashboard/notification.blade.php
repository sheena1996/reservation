
@if(session('success'))
<!----------------------------------------------------------------------------------------------------------------------------
/// SUCCESS NOTIFICATION  ////////////////////////////////////////////////////////////////////////////////////////////////////
----------------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
    (function($){   
        $(document).ready(function ($) {
          showNotificationSuccess('top', 'right', 'success');
        });
        
    })(jQuery);
    function showNotificationSuccess(from, align, type){
        $.notify({
            icon: "add_alert",
            message: "<strong>Success:</strong> {{ session('success') }}"

        },{
            type: type,
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
    }
</script>
@endif


@if(session('warning'))
<!----------------------------------------------------------------------------------------------------------------------------
/// WARNING NOTIFICATION  ////////////////////////////////////////////////////////////////////////////////////////////////////
----------------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
    (function($){   
        $(document).ready(function ($) {
          showNotificationSuccess('top', 'right', 'warning');
        });
        
    })(jQuery);
    function showNotificationSuccess(from, align, type){
        $.notify({
            icon: "add_alert",
            message: "<strong>Warning:</strong> {{ session('warning') }}"

        },{
            type: type,
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
    }
</script>
@endif



@if(session('info'))
<!----------------------------------------------------------------------------------------------------------------------------
/// INFORMATION NOTIFICATION  ////////////////////////////////////////////////////////////////////////////////////////////////////
----------------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
    (function($){   
        $(document).ready(function ($) {
          showNotificationSuccess('top', 'right', 'info');
        });
        
    })(jQuery);
    function showNotificationSuccess(from, align, type){
        $.notify({
            icon: "add_alert",
            message: "<strong>Notice:</strong> {{ session('info') }}"

        },{
            type: type,
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
    }
</script>
@endif


@if($errors->any())
<!----------------------------------------------------------------------------------------------------------------------------
/// ERROR NOTIFICATION  //////////////////////////////////////////////////////////////////////////////////////////////////////
----------------------------------------------------------------------------------------------------------------------------->
    <script type="text/javascript">
        (function($){   
            $(document).ready(function ($) {
                showNotificationError('top', 'right', 'danger');
            });
            
        })(jQuery);
        
        function showNotificationError(from, align, type){
            $.notify({
                icon: "add_alert",
                message: "<strong>Error:</strong> {{ $errors->first() }}"

            },{
                type: type,
                timer: 4000,
                placement: {
                    from: from,
                    align: align
                }
            });
        }
    </script>
@endif





