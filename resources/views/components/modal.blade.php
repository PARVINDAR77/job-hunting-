@props(['id', 'title'])

<div class="modal-backdrop" id="{{ $id }}-backdrop" style="display: none;">
    <div class="modal-dialog floating" id="{{ $id }}-dialog">
        <div class="modal-header">
            <h3 class="modal-title">{{ $title }}</h3>
            <button class="modal-close" onclick="closeModal('{{ $id }}')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="modal-body">
            {{ $slot }}
        </div>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id + '-backdrop').style.display = 'flex';
    }
    function closeModal(id) {
        document.getElementById(id + '-backdrop').style.display = 'none';
    }
</script>
