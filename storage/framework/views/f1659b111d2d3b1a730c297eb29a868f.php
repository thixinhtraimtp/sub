
<?php $__env->startSection('title', 'Phản hồi ticket hỗ trợ'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Phản hồi ticket hỗ trợ</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.ticket.ticket.update', ['id' => $ticket->id])); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="form-floating mb-3">
                            <input  class="form-control" name="body" placeholder="Nội dung hỗ trợ"
                                value="<?php echo $ticket->body; ?>" readonly>
                            <label for="body">Nội dung hỗ trợ</label>
                        </div>
                      

                        <div class="form-floating mb-3">

                        <label for="reply">Nội dung phản hồi</label>
                        <textarea class="form-control" id="reply" name="reply" placeholder="Nội dung phản hồi" style="height: 100px"></textarea>
                      

                             
                        </div>
                      
                        
                        <div class="form-group">
                            <button class="btn btn-primary col-12">
                                <i class="fas fa-save"></i> Phản hồi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="/app/js/plugins/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            height: '400',
            selector: '#reply',
            content_style: 'body { font-family: "Inter", sans-serif; }',
            menubar: false,
            toolbar: [
                'styleselect fontselect fontsizeselect',
                'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
                'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'
            ],
            plugins: 'advlist autolink link image lists charmap print preview code'
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dailysie/khosubvip.top/resources/views/admin/ticket/ticket-edit.blade.php ENDPATH**/ ?>