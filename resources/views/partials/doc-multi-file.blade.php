<script>
    window.docFilesMap = window.docFilesMap || {};

    function docKey(docTypeId) {
        return 'doc_' + docTypeId;
    }

    function renderDocFileList(docTypeId) {
        var key = docKey(docTypeId);
        var files = window.docFilesMap[key] || [];
        var container = document.getElementById('docFileList' + docTypeId);
        if (!container) return;
        container.innerHTML = '';

        files.forEach(function(file, idx) {
            var row = document.createElement('div');
            row.className = 'd-flex align-items-center justify-content-between gap-2 border rounded px-2 py-1 mb-1';
            row.style.background = '#f8f9fa';

            var nameSpan = document.createElement('span');
            nameSpan.className = 'small text-truncate';
            nameSpan.style.maxWidth = '180px';
            nameSpan.title = file.name;
            nameSpan.innerHTML = '<i class="bi bi-file-earmark-image me-1"></i>' + file.name;

            var btnGroup = document.createElement('div');
            btnGroup.className = 'd-flex gap-1 flex-shrink-0';

            var viewBtn = document.createElement('button');
            viewBtn.type = 'button';
            viewBtn.className = 'btn btn-sm btn-outline-secondary py-0 px-2';
            viewBtn.title = 'View File';
            viewBtn.innerHTML = '<i class="bi bi-eye"></i>';
            viewBtn.onclick = function() {
                window.open(URL.createObjectURL(file), '_blank');
            };

            var removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'btn btn-sm btn-outline-danger py-0 px-2';
            removeBtn.title = 'Remove File / Photo';
            removeBtn.innerHTML = '<i class="bi bi-trash"></i>';
            removeBtn.onclick = function() {
                window.docFilesMap[key].splice(idx, 1);
                syncDocInput(docTypeId);
            };

            btnGroup.appendChild(viewBtn);
            btnGroup.appendChild(removeBtn);
            row.appendChild(nameSpan);
            row.appendChild(btnGroup);
            container.appendChild(row);
        });
    }

    function syncDocInput(docTypeId) {
        var key = docKey(docTypeId);
        var files = window.docFilesMap[key] || [];
        var input = document.getElementById('docFile' + docTypeId);

        if (input) {
            var dataTransfer = new DataTransfer();
            files.forEach(function(f) { dataTransfer.items.add(f); });
            input.files = dataTransfer.files;
        }

        renderDocFileList(docTypeId);
        refreshDocLockState(docTypeId);
    }

    window.refreshDocLockState = function(docTypeId) {
        var key = docKey(docTypeId);
        var newCount = (window.docFilesMap[key] || []).length;
        var existingContainer = document.getElementById('existingDocFiles' + docTypeId);
        var existingCount = existingContainer
            ? existingContainer.querySelectorAll('[id^="existingDocRow' + docTypeId + '_"]').length
            : 0;
        var totalCount = newCount + existingCount;

        var select = document.querySelector('.doc-status-select[data-doc-type="' + docTypeId + '"]');
        if (select) {
            if (totalCount > 0) {
                if (typeof window.unlockDocSelect === 'function') window.unlockDocSelect(select);
            } else {
                if (typeof window.lockDocSelect === 'function') window.lockDocSelect(select);
            }
            if (typeof window.updateStatusOptions === 'function') window.updateStatusOptions();
        }
    };

    window.addDocFiles = function(docTypeId, fileList) {
        var key = docKey(docTypeId);
        if (!window.docFilesMap[key]) window.docFilesMap[key] = [];
        Array.from(fileList).forEach(function(f) {
            window.docFilesMap[key].push(f);
        });
        syncDocInput(docTypeId);
    };
</script>