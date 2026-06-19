<div class="modal fade" id="cameraCaptureModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 overflow-hidden">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-semibold">
                    <i class="bi bi-camera-fill me-2 text-success"></i>Take a Photo
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2">
                <div id="cameraErrorMsg" class="alert alert-warning small d-none mb-3"></div>

                <div class="ratio ratio-1x1 bg-dark rounded-3 overflow-hidden mb-3" style="max-width: 320px; margin: 0 auto;">
                    <video id="cameraVideoPreview" autoplay playsinline class="w-100 h-100" style="object-fit: cover; transform: scaleX(-1);"></video>
                    <img id="cameraCapturedPreview" class="w-100 h-100 d-none" style="object-fit: cover;" alt="Captured preview">
                </div>
                <canvas id="cameraCanvas" class="d-none"></canvas>

                <div class="d-flex justify-content-center gap-2">
                    <button type="button" id="cameraCaptureBtn" class="btn btn-success btn-sm px-4">
                        <i class="bi bi-camera me-1"></i>Capture
                    </button>
                    <button type="button" id="cameraRetakeBtn" class="btn btn-outline-secondary btn-sm px-4 d-none">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>Retake
                    </button>
                    <button type="button" id="cameraUseBtn" class="btn btn-success btn-sm px-4 d-none">
                        <i class="bi bi-check-circle me-1"></i>Use Photo
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        var cameraStream = null;
        var cameraTargetInputId = null;
        var cameraCapturedBlob = null;

        window.openCameraCapture = function(inputId) {
            cameraTargetInputId = inputId;
            cameraCapturedBlob = null;

            var modalEl = document.getElementById('cameraCaptureModal');
            var modal = new bootstrap.Modal(modalEl);
            modal.show();

            var video = document.getElementById('cameraVideoPreview');
            var errorDiv = document.getElementById('cameraErrorMsg');
            errorDiv.classList.add('d-none');
            video.classList.remove('d-none');
            document.getElementById('cameraCapturedPreview').classList.add('d-none');
            document.getElementById('cameraCaptureBtn').classList.remove('d-none');
            document.getElementById('cameraRetakeBtn').classList.add('d-none');
            document.getElementById('cameraUseBtn').classList.add('d-none');

            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                errorDiv.textContent = 'Camera is not supported on this browser. Please use "Choose Picture" instead.';
                errorDiv.classList.remove('d-none');
                video.classList.add('d-none');
                document.getElementById('cameraCaptureBtn').classList.add('d-none');
                return;
            }

            navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } })
                .then(function(stream) {
                    cameraStream = stream;
                    video.srcObject = stream;
                    video.play();
                })
                .catch(function() {
                    errorDiv.textContent = 'Camera access denied or no camera detected. Please check your browser permissions, or use "Choose Picture" instead.';
                    errorDiv.classList.remove('d-none');
                    video.classList.add('d-none');
                    document.getElementById('cameraCaptureBtn').classList.add('d-none');
                });
        };

        function stopCameraStream() {
            if (cameraStream) {
                cameraStream.getTracks().forEach(function(track) { track.stop(); });
                cameraStream = null;
            }
        }

        document.getElementById('cameraCaptureModal').addEventListener('hidden.bs.modal', stopCameraStream);

        document.getElementById('cameraCaptureBtn').addEventListener('click', function() {
            var video = document.getElementById('cameraVideoPreview');
            var canvas = document.getElementById('cameraCanvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            var ctx = canvas.getContext('2d');
            // Mirror the drawing so the saved photo matches what was shown in the preview
            ctx.translate(canvas.width, 0);
            ctx.scale(-1, 1);
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            canvas.toBlob(function(blob) {
                cameraCapturedBlob = blob;
                var capturedImg = document.getElementById('cameraCapturedPreview');
                capturedImg.src = URL.createObjectURL(blob);
                capturedImg.classList.remove('d-none');
                video.classList.add('d-none');
                document.getElementById('cameraCaptureBtn').classList.add('d-none');
                document.getElementById('cameraRetakeBtn').classList.remove('d-none');
                document.getElementById('cameraUseBtn').classList.remove('d-none');
            }, 'image/jpeg', 0.92);
        });

        document.getElementById('cameraRetakeBtn').addEventListener('click', function() {
            var video = document.getElementById('cameraVideoPreview');
            document.getElementById('cameraCapturedPreview').classList.add('d-none');
            video.classList.remove('d-none');
            document.getElementById('cameraCaptureBtn').classList.remove('d-none');
            document.getElementById('cameraRetakeBtn').classList.add('d-none');
            document.getElementById('cameraUseBtn').classList.add('d-none');
        });

        document.getElementById('cameraUseBtn').addEventListener('click', function() {
            if (!cameraCapturedBlob || !cameraTargetInputId) return;

            var fileName = 'webcam-photo-' + Date.now() + '.jpg';
            var file = new File([cameraCapturedBlob], fileName, { type: 'image/jpeg' });
            var dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);

            var input = document.getElementById(cameraTargetInputId);
            input.files = dataTransfer.files;
            input.dispatchEvent(new Event('change', { bubbles: true }));

            bootstrap.Modal.getInstance(document.getElementById('cameraCaptureModal')).hide();
        });
    })();
</script>