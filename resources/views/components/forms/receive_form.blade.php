<div class="modal fade" id="receiveModal" tabindex="-1" aria-labelledby="receiveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receiveModalLabel">بيانات الحوالة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="receiveForm">
                    <div class="mb-3">
                        <label for="transferNumber" class="form-label">رقم الحوالة</label>
                        <input type="text" id="transferNumber" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipientName" class="form-label">اسم المستفيد</label>
                        <input type="text" id="recipientName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">رقم الهاتف</label>
                        <input type="text" id="phoneNumber" class="form-control" required>
                    </div>
                    <div id="errorMessage" class="text-danger mb-3 mt-3" style="display: none;">يرجى التحقق من
                        البيانات
                        المدخلة.</div>
                    <button type="button" class="btn btn-primary w-100" onclick="submitReceiveForm()">تحقق</button>
                </form>
            </div>
        </div>
    </div>
</div>
