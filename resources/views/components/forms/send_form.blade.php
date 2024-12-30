<div class="modal fade" id="sendModal" tabindex="-1" aria-labelledby="sendModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendModalLabel">بيانات الإرسال</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="sendForm">
                    <!-- الحقول الأساسية -->
                    <input type="hidden" id="employee_id" value="{{ auth()->user()->id }}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="senderName" class="form-label">اسم المرسل</label>
                            <input type="text" id="senderName" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="senderPhone" class="form-label">رقم هاتف المرسل</label>
                            <input type="tel" maxlength="15" id="senderPhone" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="receiverName" class="form-label">اسم المستلم</label>
                            <input type="text" id="receiverName" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="receiverPhone" class="form-label">رقم هاتف المستلم</label>
                            <input type="tel" maxlength="15" id="receiverPhone" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="amount" class="form-label">المبلغ</label>
                            <input type="number" minlength="1" maxlength="4" id="amount" class="form-control"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="country" class="form-label">الدولة</label>
                            @if (is_array($countries) || is_object($countries))
                                <select id="country" class="form-select" required>
                                    @foreach ($countries as $item)
                                        <option value="{{ $item->value }}">{{ $item->label }}</option>
                                    @endforeach
                                </select>
                            @else
                                <p>لا توجد بيانات لعرضها.</p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label">نوع العملية</label>
                            <select id="type" class="form-select" required>
                                <option value="send" selected>إرسال</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="paid" class="form-label">طريقة الدفع</label>
                            <select id="paid" class="form-select" required onchange="toggleBankFields()">
                                <option value="cash">نقدًا</option>
                                <option value="bank">بنك</option>
                            </select>
                        </div>
                    </div>

                    <!-- الحقول البنكية -->
                    <div id="bankFields" style="display: none;">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="iban" class="form-label">IBAN</label>
                                <input type="text" id="iban" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="swift" class="form-label">SWIFT</label>
                                <input type="text" id="swift" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="bankName" class="form-label">اسم البنك</label>
                                <input type="text" id="bankName" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3" style="display: none;">
                                <label for="ifsc" class="form-label">IFSC</label>
                                <input type="text" id="ifsc" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3" style="display: none;">
                                <label for="routingNumber" class="form-label">Routing Number</label>
                                <input type="text" id="routingNumber" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3" style="display: none;">
                                <label for="bankCity" class="form-label">مدينة البنك</label>
                                <input type="text" id="bankCity" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div id="errorMessageSend" class="text-danger mb-3 mt-3" style="display: none;">يرجى التحقق من
                        البيانات
                        المدخلة.</div>
                    <button type="button" class="btn btn-primary w-100" onclick="submitSendForm()">إرسال</button>
                </form>
            </div>
        </div>
    </div>
</div>
