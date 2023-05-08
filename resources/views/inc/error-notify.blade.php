@if (session()->has('success_added'))
<script>
    window.onload = function() {
        notif({
            msg: "تم اضافه الفاتوره بنجاح",
            type: "success"
        })
    }
</script>
@endif
@if (session()->has('success_update'))
<script>
    window.onload = function() {
        notif({
            msg: "تم تعديل الفاتورة بنجاح",
            type: "success"
        })
    }
</script>
@endif
@if (session()->has('success_delete'))
<script>
    window.onload = function() {
        notif({
            msg: "تم حذف الفاتورة بنجاح",
            type: "success"
        })
    }
</script>
@endif
@if (session()->has('success_archieve'))
<script>
    window.onload = function() {
        notif({
            msg: "تم ارشفه الفاتورة بنجاح",
            type: "success"
        })
    }
</script>
@endif
@if (session()->has('failed_archieve'))
<script>
    window.onload = function() {
        notif({
            msg: "يجب ان تكون الفاتوره مدفوعه لكى تنقل للارشيف",
            type: "warning"
        })
    }
</script>
@endif


@if (session()->has('Status_Update'))
<script>
    window.onload = function() {
        notif({
            msg: "تم تحديث حالة الدفع بنجاح",
            type: "success"
        })
    }
</script>
@endif

@if (session()->has('restore_invoice'))
<script>
    window.onload = function() {
        notif({
            msg: "تم استعادة الفاتورة بنجاح",
            type: "success"
        })
    }
</script>
@endif