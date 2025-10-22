<section>
    <div class="alert alert-danger">
        <h5 class="alert-heading">
            <i class="fas fa-exclamation-triangle me-2"></i>Cảnh báo!
        </h5>
        <p class="mb-0">
            Khi tài khoản bị xóa, tất cả dữ liệu và tài nguyên sẽ bị xóa vĩnh viễn. 
            Trước khi xóa tài khoản, vui lòng tải xuống mọi dữ liệu hoặc thông tin mà bạn muốn giữ lại.
        </p>
    </div>

    <button type="button" 
            class="btn btn-danger" 
            data-bs-toggle="modal" 
            data-bs-target="#deleteAccountModal">
        <i class="fas fa-trash-alt me-2"></i>Xóa tài khoản
    </button>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteAccountModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Xác nhận xóa tài khoản
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    
                    <div class="modal-body">
                        <p class="text-danger fw-bold">
                            Bạn có chắc chắn muốn xóa tài khoản của mình?
                        </p>
                        <p class="text-muted">
                            Sau khi tài khoản bị xóa, tất cả dữ liệu và tài nguyên sẽ bị xóa vĩnh viễn. 
                            Vui lòng nhập mật khẩu để xác nhận bạn muốn xóa tài khoản vĩnh viễn.
                        </p>

                        <div class="mb-3">
                            <label for="delete_password" class="form-label">Mật khẩu</label>
                            <input type="password" 
                                   class="form-control @error('password', 'userDeletion') is-invalid @enderror" 
                                   id="delete_password" 
                                   name="password" 
                                   placeholder="Nhập mật khẩu"
                                   required>
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Hủy
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt me-2"></i>Xóa tài khoản
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if($errors->userDeletion->isNotEmpty())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
            deleteModal.show();
        });
    </script>
    @endif
</section>
