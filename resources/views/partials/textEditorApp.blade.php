<style>
    #editorModal .text-editor-window {
        position: fixed;
        width: 90vw;
        height: 84vh;
        background-color: #E2D8CC;
        border-radius: 1rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        display: flex;
        flex-direction: column;
        top: 50px;
        left: 50%;
        transform: translateX(-50%);
        resize: both;
        overflow: hidden;
        user-select: none;
        pointer-events: auto;
    }

    #editorModal .text-editor-window.maximized {
        width: 100%;
        height: calc(100vh - 72px);
        top: 0;
        left: 0;
        transform: none;
        border-radius: 0;
        position: fixed;
    }

    #editorModal .editor-header {
        background-color: #443C3D;
        color: white;
        padding: 0.75rem 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: move;
        border-radius: 1rem 1rem 0 0;
        flex-shrink: 0;
    }

    #editorModal .text-editor-window.maximized .editor-header {
        border-radius: 0;
    }

    #editorModal .editor-header-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
    }

    #editorModal .editor-controls {
        display: flex;
        gap: 0.75rem;
    }

    #editorModal .editor-btn {
        width: 28px;
        height: 28px;
        border: none;
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        border-radius: 0.25rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.2s;
        font-size: 0.875rem;
    }

    #editorModal .editor-btn:hover {
        background-color: rgba(255, 255, 255, 0.35);
    }

    #editorModal .editor-btn.close:hover {
        background-color: #d32f2f;
    }

    #editorModal .editor-toolbar {
        background-color: #D0C4B4;
        padding: 0.75rem 1rem;
        display: flex;
        gap: 0.75rem;
        align-items: center;
        flex-wrap: wrap;
        flex-shrink: 0;
        border-bottom: 1px solid #c4b8a8;
    }

    #editorModal .toolbar-group {
        display: flex;
        gap: 0.25rem;
        align-items: center;
    }

    #editorModal .toolbar-actions {
        margin-left: auto;
        width: auto;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.75rem;
    }

    @media (max-width: 600px) {
        #editorModal .toolbar-actions {
            margin-left: 0;
            width: 100%;
            justify-content: center;
        }
    }

    #editorModal .toolbar-btn {
        width: 42px;
        height: 42px;
        border: 1px solid #443C3D;
        background-color: white;
        color: #443C3D;
        border-radius: 0.45rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        font-size: 1.05rem;
    }

    #editorModal .toolbar-group:first-of-type .toolbar-btn {
        font-size: 1.2rem;
        font-weight: 700;
    }

    #editorModal .toolbar-group:last-of-type .toolbar-btn i {
        font-size: 1.05rem;
    }

    #editorModal .toolbar-btn:hover {
        background-color: #443C3D;
        color: white;
    }

    #editorModal .toolbar-separator {
        width: 1px;
        height: 24px;
        background-color: #b5a89b;
    }

    #editorModal .editor-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    #editorModal .editor-rich {
        flex: 1;
        border: none;
        outline: none;
        padding: 1.5rem;
        font-family: 'Figtree', sans-serif;
        font-size: 1rem;
        overflow: auto;
        background-color: white;
        color: #443C3D;
        white-space: pre-wrap;
        line-height: 1.45;
    }

    #editorModal .editor-rich:empty::before {
        content: attr(data-placeholder);
        color: #b5a89b;
    }

    #editorModal .te-bottom-bar {
        background-color: #D0C4B4;
        padding: 0.75rem 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-shrink: 0;
        border-top: 1px solid #c4b8a8;
    }

    #editorModal .notes-info {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    #editorModal .notes-btn,
    #editorModal .new-btn,
    #editorModal .save-btn {
        padding: 0.5rem 1rem;
        border: 1px solid #443C3D;
        border-radius: 0.375rem;
        background-color: white;
        color: #443C3D;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    #editorModal .notes-btn:hover,
    #editorModal .new-btn:hover {
        background-color: #443C3D;
        color: white;
    }

    #editorModal .save-btn {
        background-color: #443C3D;
        color: white;
    }

    #editorModal .save-btn:hover {
        background-color: #5a5250;
    }

    #editorModal .resize-handle {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 20px;
        height: 20px;
        cursor: se-resize;
        background: linear-gradient(135deg, transparent 50%, #443C3D 50%);
        opacity: 0.3;
    }

    #editorModal .text-editor-window.maximized .resize-handle {
        display: none;
    }

    #editorModal .save-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 2600;
        pointer-events: auto;
    }

    #editorModal .save-modal-backdrop.active {
        display: flex;
    }

    #editorModal .save-modal {
        width: min(780px, calc(100% - 24px));
        max-height: calc(100% - 24px);
        overflow: auto;
        background: #E2D8CC;
        border: 2px solid #5a5250;
        border-radius: 16px;
        padding: 18px;
        color: #443C3D;
    }

    #editorModal .save-modal-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    #editorModal .save-modal-title {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
    }

    #editorModal .save-close-btn {
        width: 32px;
        height: 32px;
        border: none;
        border-radius: 8px;
        background: transparent;
        color: #443C3D;
        cursor: pointer;
        font-size: 1.2rem;
    }

    #editorModal .save-close-btn:hover {
        background: rgba(68, 60, 61, 0.12);
    }

    #editorModal .save-label {
        font-weight: 700;
        font-size: 1.02rem;
        margin-bottom: 8px;
    }

    #editorModal .save-segmented,
    #editorModal .save-segmented-small {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 14px;
    }

    #editorModal .save-segmented-btn {
        border: 2px solid #5a5250;
        border-radius: 14px;
        background: #f2f2f2;
        color: #443C3D;
        padding: 12px 14px;
        font-size: 1.05rem;
        font-weight: 700;
        cursor: pointer;
    }

    #editorModal .save-segmented-btn.active {
        background: #4d4548;
        color: #E2D8CC;
    }

    #editorModal .save-input {
        width: 100%;
        border: 2px solid #5a5250;
        border-radius: 14px;
        background: #f2f2f2;
        color: #443C3D;
        padding: 10px 12px;
        font-size: 1.1rem;
        outline: none;
    }

    #editorModal .save-folders-grid {
        margin-top: 8px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    #editorModal .save-folder-btn,
    #editorModal .save-existing-book-btn {
        border: 2px solid #b8b1aa;
        border-radius: 14px;
        background: #f2f2f2;
        color: #443C3D;
        padding: 10px 12px;
        text-align: left;
        font-weight: 700;
        cursor: pointer;
    }

    #editorModal .save-folder-btn.active,
    #editorModal .save-existing-book-btn.active {
        border-color: #4d4548;
        background: #4d4548;
        color: #E2D8CC;
    }

    #editorModal .save-muted {
        color: #9a9289;
        font-size: 0.96rem;
        font-style: italic;
    }

    #editorModal .save-section {
        border-top: 2px solid #5a5250;
        margin-top: 12px;
        padding-top: 12px;
    }

    #editorModal .save-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-top: 16px;
    }

    #editorModal .save-cancel-btn,
    #editorModal .save-confirm-btn {
        border-radius: 14px;
        padding: 12px 14px;
        font-weight: 800;
        font-size: 1rem;
        cursor: pointer;
    }

    #editorModal .save-cancel-btn {
        border: 2px solid #5a5250;
        background: #f2f2f2;
        color: #443C3D;
    }

    #editorModal .save-confirm-btn {
        border: none;
        background: #9f968d;
        color: #E2D8CC;
    }

    #editorModal .save-confirm-btn.enabled {
        background: #443C3D;
    }

    #editorModal .save-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 10px;
    }

    #editorModal .drafts-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 2600;
        pointer-events: auto;
    }

    #editorModal .drafts-modal-backdrop.active {
        display: flex;
    }

    #editorModal .drafts-modal {
        width: min(780px, calc(100% - 24px));
        max-height: calc(100% - 24px);
        overflow: auto;
        background: #E2D8CC;
        border: 2px solid #5a5250;
        border-radius: 16px;
        padding: 18px;
        color: #443C3D;
    }

    #editorModal .drafts-list {
        margin-top: 12px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    #editorModal .draft-item {
        border: 2px solid #b8b1aa;
        border-radius: 14px;
        background: #f2f2f2;
        padding: 10px 12px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
    }

    #editorModal .draft-item.active {
        border-color: #4d4548;
    }

    #editorModal .draft-title {
        font-size: 1rem;
        font-weight: 800;
    }

    #editorModal .draft-preview {
        margin-top: 4px;
        font-size: 0.92rem;
        color: #5a5250;
    }

    #editorModal .draft-meta {
        margin-top: 6px;
        font-size: 0.8rem;
        color: #7a726a;
    }

    #editorModal .draft-actions {
        display: flex;
        gap: 8px;
        flex-shrink: 0;
    }

    #editorModal .draft-action-btn {
        border: 1px solid #5a5250;
        border-radius: 10px;
        background: white;
        color: #443C3D;
        padding: 7px 10px;
        font-size: 0.84rem;
        font-weight: 700;
        cursor: pointer;
    }

    #editorModal .draft-action-btn:hover {
        background: #443C3D;
        color: #E2D8CC;
    }

    #editorModal .draft-action-btn.delete:hover {
        background: #b3261e;
        border-color: #b3261e;
        color: #fff;
    }

    @media (max-width: 768px) {
        #editorModal .save-modal-backdrop,
        #editorModal .drafts-modal-backdrop {
            align-items: flex-start;
            padding: 8px 6px;
        }

        #editorModal .save-modal,
        #editorModal .drafts-modal {
            width: 100%;
            max-height: calc(100dvh - 16px);
            padding: 12px;
            border-radius: 12px;
        }

        #editorModal .save-modal-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="text-editor-window" id="editorWindow">
    <div class="editor-header" id="editorHeader">
        <div class="editor-header-title">
            <i class="fas fa-file-alt"></i>
            <span>Editor de Texto</span>
        </div>
        <div class="editor-controls">
            <button type="button" class="editor-btn minimize-btn" onclick="minimizeEditor(event)">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="editor-btn maximize-btn" onclick="toggleMaximizeEditor(event)">
                <i class="fas fa-square"></i>
            </button>
            <button type="button" class="editor-btn close" onclick="closeEditor(event)">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <div class="editor-toolbar">
        <div class="toolbar-group">
            <button class="toolbar-btn" onclick="execCmd('bold')" title="Negrita"><strong>B</strong></button>
            <button class="toolbar-btn" onclick="execCmd('italic')" title="Cursiva"><i>I</i></button>
            <button class="toolbar-btn" onclick="execCmd('underline')" title="Subrayado"><u>U</u></button>
        </div>

        <div class="toolbar-separator"></div>

        <div class="toolbar-group">
            <button class="toolbar-btn" onclick="execCmd('justifyLeft')" title="Alinear izquierda"><i class="fas fa-align-left"></i></button>
            <button class="toolbar-btn" onclick="execCmd('justifyCenter')" title="Centrar"><i class="fas fa-align-center"></i></button>
            <button class="toolbar-btn" onclick="execCmd('justifyRight')" title="Alinear derecha"><i class="fas fa-align-right"></i></button>
        </div>

        <div class="toolbar-actions">
            <button class="new-btn" onclick="openDraftsModal()">
                <i class="fas fa-file-alt"></i>
                <span>Borradores</span>
            </button>
            <button class="save-btn" onclick="openSaveModal()">
                <i class="fas fa-save"></i>
                <span>Guardar</span>
            </button>
        </div>
    </div>

    <div class="editor-content">
        <div class="editor-rich" id="editorRichContent" contenteditable="true" data-placeholder="Comienza a escribir tu nota..."></div>
    </div>

    <div class="resize-handle" id="resizeHandle"></div>
</div>

<div class="save-modal-backdrop" id="saveEditorModal">
    <div class="save-modal">
        <div class="save-modal-head">
            <div class="save-modal-title">Guardar</div>
            <button type="button" class="save-close-btn" onclick="closeSaveModal()"><i class="fas fa-times"></i></button>
        </div>

        <div class="save-label">¿Dónde guardar?</div>
        <div class="save-segmented">
            <button type="button" id="saveTargetNoteBtn" class="save-segmented-btn active" onclick="setSaveTarget('note')"><i class="far fa-folder"></i> Archivo / Nota</button>
            <button type="button" id="saveTargetBookBtn" class="save-segmented-btn" onclick="setSaveTarget('book')"><i class="fas fa-book-open"></i> Libro</button>
        </div>

        <div id="saveNoteSection">
            <div class="save-label">Nombre de la nota</div>
            <input id="saveNoteNameInput" class="save-input" placeholder="mi-nota" />

            <div class="save-section">
                <div class="save-label"><i class="far fa-folder" style="margin-right:6px;"></i> Carpeta</div>
                <div id="saveFoldersGrid" class="save-folders-grid"></div>
            </div>

            <div class="save-section" style="border-top: 2px solid #5a5250;">
                <label style="display:flex; gap:8px; align-items:center; font-weight:700; cursor:pointer;">
                    <input type="checkbox" id="saveEncryptCheck" onchange="toggleSaveEncrypt()" />
                    <span><i class="fas fa-lock"></i> Encriptar archivo</span>
                </label>
                <input id="saveEncryptPassword" type="password" class="save-input" placeholder="Contraseña" style="display:none; margin-top:8px;" />
            </div>
        </div>

        <div id="saveBookSection" style="display:none;">
            <div class="save-label">¿Es un libro nuevo o capítulo de uno existente?</div>
            <div class="save-segmented-small">
                <button type="button" id="saveBookNewBtn" class="save-segmented-btn active" onclick="setBookMode('new')"><i class="fas fa-plus"></i> Libro nuevo</button>
                <button type="button" id="saveBookExistingBtn" class="save-segmented-btn" onclick="setBookMode('existing')"><i class="fas fa-chevron-right"></i> Libro existente</button>
            </div>

            <div id="saveBookNewForm">
                <div class="save-row-2">
                    <div>
                        <div class="save-label">Título del libro *</div>
                        <input id="saveBookTitleInput" class="save-input" placeholder="Mi novela" />
                    </div>
                    <div>
                        <div class="save-label">Autor *</div>
                        <input id="saveBookAuthorInput" class="save-input" placeholder="Tu nombre" />
                    </div>
                </div>
                <div style="margin-top:10px;">
                    <div class="save-label">Nombre del primer capítulo *</div>
                    <input id="saveBookFirstChapterInput" class="save-input" placeholder="Capítulo 1: El comienzo" />
                </div>
                <div class="save-muted" style="margin-top:10px;">El libro se creará en la Biblioteca y el contenido actual se guardará como capítulo.</div>
            </div>

            <div id="saveBookExistingForm" style="display:none;">
                <div class="save-label">Nombre del capítulo *</div>
                <input id="saveBookExistingChapterInput" class="save-input" placeholder="Capítulo nuevo" />

                <div style="margin-top:10px;" class="save-label">Selecciona el libro</div>
                <div id="saveExistingBooksList" style="display:flex; flex-direction:column; gap:8px;"></div>
            </div>
        </div>

        <div class="save-actions">
            <button type="button" class="save-cancel-btn" onclick="closeSaveModal()">Cancelar</button>
            <button type="button" id="saveConfirmBtn" class="save-confirm-btn enabled" onclick="saveFromEditorModal()">Guardar</button>
        </div>
    </div>
</div>

<div class="drafts-modal-backdrop" id="draftsEditorModal">
    <div class="drafts-modal">
        <div class="save-modal-head">
            <div class="save-modal-title">Borradores</div>
            <button type="button" class="save-close-btn" onclick="closeDraftsModal()"><i class="fas fa-times"></i></button>
        </div>

        <div class="save-muted">Aquí se guardan los escritos que aún no has enviado a Libros o Archivos.</div>

        <div class="save-actions" style="margin-top:12px;">
            <button type="button" class="save-cancel-btn" onclick="startBlankDraft()"><i class="fas fa-plus"></i> Nuevo borrador</button>
            <button type="button" class="save-confirm-btn enabled" onclick="closeDraftsModal()">Cerrar</button>
        </div>

        <div id="editorDraftsList" class="drafts-list"></div>
    </div>
</div>

<script>
    let isEditorMaximized = false;
    let isEditorDragging = false;
    let isEditorResizing = false;
    let editorDragOffsetX = 0;
    let editorDragOffsetY = 0;
    let editorStartX, editorStartY, editorStartWidth, editorStartHeight;

    const EDITOR_MIN_WIDTH = 320;
    const EDITOR_MIN_HEIGHT = 240;
    const EDITOR_USER_ROLE = @json(session('user_type', 'guest'));
    const EDITOR_CSRF = @json(csrf_token());
    const NOTE_IMAGE_PREVIEW = 'https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=900&q=80';

    const editorWindow = document.getElementById('editorWindow');
    const editorHeader = document.getElementById('editorHeader');
    const editorResizeHandle = document.getElementById('resizeHandle');

    let currentSaveTarget = 'note';
    let currentBookMode = 'new';
    let selectedSaveFolderId = null;
    let selectedExistingBookId = null;
    let currentDraftId = null;
    let editorDraftSaveTimeout = null;
    let editorFilesCache = { folders: [], files: [] };
    let editorBooksCache = [];
    let editorDraftsCache = [];

    function escapeEditorHtml(text) {
        return (text || '')
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#39;');
    }

    async function editorApi(url, options = {}) {
        const headers = {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            ...options.headers,
        };

        if (options.body && !(options.body instanceof FormData)) {
            headers['Content-Type'] = 'application/json';
            headers['X-CSRF-TOKEN'] = EDITOR_CSRF;
        }

        if ((options.method || 'GET').toUpperCase() !== 'GET' && !headers['X-CSRF-TOKEN']) {
            headers['X-CSRF-TOKEN'] = EDITOR_CSRF;
        }

        const response = await fetch(url, {
            credentials: 'same-origin',
            ...options,
            headers,
        });

        const data = await response.json().catch(() => ({}));
        if (!response.ok) {
            throw new Error(data?.message || 'No se pudo completar la operación.');
        }

        return data;
    }

    async function loadEditorFilesData() {
        const response = await editorApi('/archivos/carpetas');
        editorFilesCache = {
            folders: Array.isArray(response?.folders)
                ? response.folders.map(folder => ({
                    id: String(folder.id),
                    name: folder.name || 'Sin nombre',
                }))
                : [],
            files: [],
        };
    }

    async function loadEditorLibraryBooks() {
        const response = await editorApi('/biblioteca/libros');
        const books = Array.isArray(response?.books) ? response.books : [];

        editorBooksCache = books.map(book => ({
            id: String(book.id),
            title: book.title || '',
            author: book.author || '',
            synopsis: book.description || '',
            status: book.status || 'En emisión',
            cover: book.cover_path || '',
            totalChapters: Array.isArray(book.chapters) ? book.chapters.length : 0,
            currentChapter: 0,
            chapters: Array.isArray(book.chapters)
                ? book.chapters.map((chapter, index) => ({
                    id: String(chapter.id),
                    title: chapter.chapter_title || `Capítulo ${index + 1}`,
                    content: chapter.html_content || chapter.text_content || '',
                    chapterNumber: Number(chapter.chapter_number || index + 1),
                }))
                : [],
        }));
    }

    function getEditorFilesData() {
        return editorFilesCache;
    }

    function setEditorFilesData(data) {
        editorFilesCache = data;
    }

    function getEditorLibraryBooks() {
        return editorBooksCache;
    }

    function setEditorLibraryBooks(items) {
        editorBooksCache = items;
    }

    function getEditorDrafts() {
        return Array.isArray(editorDraftsCache) ? editorDraftsCache : [];
    }

    function setEditorDrafts(items) {
        editorDraftsCache = Array.isArray(items) ? items : [];
    }

    function resetEditorHeaderTitle() {
        const titleNode = document.querySelector('#editorModal .editor-header-title span');
        if (titleNode) titleNode.textContent = 'Editor de Texto';
    }

    function formatDraftDate(isoString) {
        if (!isoString) return 'Sin fecha';
        const date = new Date(isoString);
        if (Number.isNaN(date.getTime())) return 'Sin fecha';
        return date.toLocaleString('es-MX', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
        });
    }

    function buildDraftTitleFromText(text) {
        const safeText = (text || '').replace(/\s+/g, ' ').trim();
        if (!safeText) return 'Borrador sin título';
        return safeText.slice(0, 52);
    }

    function buildDraftPreviewFromText(text) {
        const safeText = (text || '').replace(/\s+/g, ' ').trim();
        if (!safeText) return 'Sin contenido';
        return safeText.slice(0, 120);
    }

    async function loadEditorDrafts() {
        try {
            const data = await editorApi('/archivos/borradores');
            const drafts = Array.isArray(data?.drafts) ? data.drafts : [];
            setEditorDrafts(drafts);
            return drafts;
        } catch (error) {
            console.error('Error loading drafts:', error);
            return [];
        }
    }

    async function persistCurrentContentAsDraft() {
        const html = getEditorContentHtml();
        const text = getEditorContentText();

        if (!html || !text) {
            return null;
        }

        const draftTitle = buildDraftTitleFromText(text);

        try {
            const response = await editorApi('/archivos/borradores', {
                method: 'POST',
                body: JSON.stringify({
                    draft_id: currentDraftId || null,
                    title: draftTitle,
                    text_content: text,
                    html_content: html,
                }),
            });

            if (response?.draft) {
                currentDraftId = response.draft.id;
                return response.draft.id;
            }
            return null;
        } catch (error) {
            console.error('Error saving draft:', error);
            return null;
        }
    }

    function removeCurrentDraftIfExists() {
        if (!currentDraftId) return;
        const drafts = getEditorDrafts().filter(item => item.id !== currentDraftId);
        setEditorDrafts(drafts);
        currentDraftId = null;
    }

    function renderDraftsList() {
        const wrap = document.getElementById('editorDraftsList');
        if (!wrap) return;

        const drafts = getEditorDrafts().sort((a, b) => {
            return new Date(b.updated_at || 0).getTime() - new Date(a.updated_at || 0).getTime();
        });

        if (drafts.length === 0) {
            wrap.innerHTML = '<div class="save-muted">No hay borradores guardados todavía.</div>';
            return;
        }

        wrap.innerHTML = drafts.map(draft => `
            <div class="draft-item ${currentDraftId === draft.id ? 'active' : ''}">
                <div style="min-width:0;">
                    <div class="draft-title">${escapeEditorHtml(draft.title || 'Borrador sin título')}</div>
                    <div class="draft-preview">${escapeEditorHtml(buildDraftPreviewFromText(draft.text_content || ''))}</div>
                    <div class="draft-meta">Actualizado: ${escapeEditorHtml(formatDraftDate(draft.updated_at || draft.created_at))}</div>
                </div>
                <div class="draft-actions">
                    <button type="button" class="draft-action-btn" onclick="loadDraftIntoEditor('${draft.id}')">Continuar</button>
                    <button type="button" class="draft-action-btn delete" onclick="deleteDraftById('${draft.id}')"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        `).join('');
    }

    async function openDraftsModal() {
        await persistCurrentContentAsDraft();
        await loadEditorDrafts();
        renderDraftsList();
        document.getElementById('draftsEditorModal')?.classList.add('active');
    }

    function closeDraftsModal() {
        document.getElementById('draftsEditorModal')?.classList.remove('active');
    }

    function loadDraftIntoEditor(draftId) {
        const drafts = getEditorDrafts();
        const draft = drafts.find(item => item.id === parseInt(draftId));
        if (!draft) {
            alert('No se encontró el borrador seleccionado.');
            return;
        }

        const editor = document.getElementById('editorRichContent');
        if (!editor) return;

        editor.innerHTML = draft.html_content || '';
        editor.focus();
        currentDraftId = draft.id;
        closeDraftsModal();
        resetEditorHeaderTitle();
    }

    async function deleteDraftById(draftId) {
        if (!confirm('¿Estás seguro de que deseas eliminar este borrador?')) {
            return;
        }

        try {
            await editorApi(`/archivos/borradores/${draftId}`, {
                method: 'DELETE',
            });

            if (currentDraftId === parseInt(draftId)) {
                currentDraftId = null;
            }

            await loadEditorDrafts();
            renderDraftsList();
        } catch (error) {
            alert(error.message || 'No se pudo eliminar el borrador.');
            console.error('Error deleting draft:', error);
        }
    }

    function startBlankDraft() {
        const editor = document.getElementById('editorRichContent');
        if (editor) {
            editor.innerHTML = '';
            editor.focus();
        }
        currentDraftId = null;
        resetEditorHeaderTitle();
        closeDraftsModal();
    }

    function findChapterInBooks(bookId, chapterId) {
        const books = getEditorLibraryBooks();
        const book = books.find(item => item.id === bookId);
        if (!book) return null;
        const chapters = Array.isArray(book.chapters) ? book.chapters : [];
        const chapter = chapters.find(item => item.id === chapterId);
        if (!chapter) return null;

        return { book, chapter };
    }

    function openChapterInEditorContent({ bookId, chapterId, chapterTitle = '', content = '' }) {
        const editor = document.getElementById('editorRichContent');
        if (!editor) return;

        let htmlToLoad = content || '';
        if (!htmlToLoad && bookId && chapterId) {
            const found = findChapterInBooks(bookId, chapterId);
            htmlToLoad = found?.chapter?.content || '';
            if (!chapterTitle) {
                chapterTitle = found?.chapter?.title || '';
            }
        }

        if (!htmlToLoad) {
            alert('No se encontró contenido para este capítulo.');
            return;
        }

        editor.innerHTML = htmlToLoad;
        editor.focus();
        currentDraftId = null;

        const titleNode = document.querySelector('#editorModal .editor-header-title span');
        if (titleNode && chapterTitle) {
            titleNode.textContent = `Editor de Texto · ${chapterTitle}`;
        }
    }

    function renderSaveFolders() {
        const data = getEditorFilesData();
        const wrap = document.getElementById('saveFoldersGrid');
        if (!wrap) return;

        if (!selectedSaveFolderId) {
            selectedSaveFolderId = data.folders[0]?.id || null;
        }

        wrap.innerHTML = data.folders.length > 0
            ? data.folders.map(folder => `
                <button type="button" class="save-folder-btn ${selectedSaveFolderId === folder.id ? 'active' : ''}" onclick="selectSaveFolder('${folder.id}')">
                    <i class="far fa-folder"></i> ${escapeEditorHtml(folder.name)}
                </button>
            `).join('')
            : '<div class="save-muted">No hay carpetas. Crea una en Archivos.</div>';
    }

    function selectSaveFolder(folderId) {
        selectedSaveFolderId = folderId;
        renderSaveFolders();
    }

    function renderExistingBooks() {
        const books = getEditorLibraryBooks();
        const wrap = document.getElementById('saveExistingBooksList');
        if (!wrap) return;

        if (!selectedExistingBookId) {
            selectedExistingBookId = books[0]?.id || null;
        }

        wrap.innerHTML = books.length > 0
            ? books.map(book => `
                <button type="button" class="save-existing-book-btn ${selectedExistingBookId === book.id ? 'active' : ''}" onclick="selectExistingBook('${book.id}')">
                    <div style="font-size:1.1rem; font-weight:800;">${escapeEditorHtml(book.title)}</div>
                    <div style="font-size:0.9rem; opacity:0.9;">${escapeEditorHtml(book.author)} · ${Number(book.totalChapters || 1)} cap.</div>
                </button>
            `).join('')
            : '<div class="save-muted">No hay libros. Crea uno nuevo.</div>';
    }

    function selectExistingBook(bookId) {
        selectedExistingBookId = bookId;
        renderExistingBooks();
    }

    function setSaveTarget(target) {
        currentSaveTarget = target;
        const noteBtn = document.getElementById('saveTargetNoteBtn');
        const bookBtn = document.getElementById('saveTargetBookBtn');
        const noteSection = document.getElementById('saveNoteSection');
        const bookSection = document.getElementById('saveBookSection');

        noteBtn.classList.toggle('active', target === 'note');
        bookBtn.classList.toggle('active', target === 'book');
        noteSection.style.display = target === 'note' ? 'block' : 'none';
        bookSection.style.display = target === 'book' ? 'block' : 'none';
    }

    function setBookMode(mode) {
        currentBookMode = mode;
        const newBtn = document.getElementById('saveBookNewBtn');
        const existingBtn = document.getElementById('saveBookExistingBtn');
        const newForm = document.getElementById('saveBookNewForm');
        const existingForm = document.getElementById('saveBookExistingForm');

        newBtn.classList.toggle('active', mode === 'new');
        existingBtn.classList.toggle('active', mode === 'existing');
        newForm.style.display = mode === 'new' ? 'block' : 'none';
        existingForm.style.display = mode === 'existing' ? 'block' : 'none';
    }

    function toggleSaveEncrypt() {
        const checked = document.getElementById('saveEncryptCheck').checked;
        const input = document.getElementById('saveEncryptPassword');
        input.style.display = checked ? 'block' : 'none';
        if (!checked) input.value = '';
    }

    async function openSaveModal() {
        const content = getEditorContentText();
        if (!content) {
            alert('La nota está vacía. Escribe algo antes de guardar.');
            return;
        }

        try {
            await Promise.all([
                loadEditorFilesData(),
                loadEditorLibraryBooks(),
            ]);
        } catch (error) {
            alert(error.message || 'No se pudieron cargar carpetas/libros.');
            return;
        }

        renderSaveFolders();
        renderExistingBooks();
        setSaveTarget('note');
        setBookMode('new');
        document.getElementById('saveEncryptCheck').checked = false;
        document.getElementById('saveEncryptPassword').value = '';
        document.getElementById('saveEncryptPassword').style.display = 'none';
        document.getElementById('saveEditorModal').classList.add('active');
    }

    function closeSaveModal() {
        document.getElementById('saveEditorModal').classList.remove('active');
    }

    async function saveAsFileNote(content) {
        const noteName = document.getElementById('saveNoteNameInput').value.trim();
        const encrypted = document.getElementById('saveEncryptCheck').checked;
        const password = document.getElementById('saveEncryptPassword').value;

        if (!noteName) {
            alert('Ingresa nombre de la nota.');
            return false;
        }

        if (!selectedSaveFolderId) {
            alert('Selecciona una carpeta de destino.');
            return false;
        }

        if (encrypted && !password) {
            alert('Ingresa la contraseña para encriptar.');
            return false;
        }

        await editorApi('/archivos/escritos', {
            method: 'POST',
            body: JSON.stringify({
                title: noteName,
                folder_id: Number(selectedSaveFolderId),
                image_path: NOTE_IMAGE_PREVIEW,
                text_content: getEditorContentText(),
                html_content: content,
                password: encrypted ? password : null,
            }),
        });
        return true;
    }

    async function saveAsBookChapter(content) {
        const books = getEditorLibraryBooks();

        if (currentBookMode === 'new') {
            const title = document.getElementById('saveBookTitleInput').value.trim();
            const author = document.getElementById('saveBookAuthorInput').value.trim();
            const firstChapterName = document.getElementById('saveBookFirstChapterInput').value.trim();

            if (!title || !author || !firstChapterName) {
                alert('Completa título, autor y nombre del primer capítulo.');
                return false;
            }

            const bookResponse = await editorApi('/biblioteca/libros', {
                method: 'POST',
                body: JSON.stringify({
                    title,
                    author,
                    description: '',
                    status: 'En emisión',
                    cover_path: null,
                }),
            });

            const bookId = String(bookResponse?.book?.id || '');
            if (!bookId) {
                alert('No se pudo crear el libro.');
                return false;
            }

            await editorApi(`/biblioteca/libros/${bookId}/asignaciones`, {
                method: 'POST',
                body: JSON.stringify({
                    chapter_number: 1,
                    chapter_title: firstChapterName,
                    text_content: getEditorContentText(),
                    html_content: content,
                }),
            });

            await loadEditorLibraryBooks();
            return true;
        }

        const chapterName = document.getElementById('saveBookExistingChapterInput').value.trim();
        if (!chapterName) {
            alert('Ingresa el nombre del capítulo.');
            return false;
        }

        if (!selectedExistingBookId) {
            alert('Selecciona un libro existente.');
            return false;
        }

        const index = books.findIndex(item => item.id === selectedExistingBookId);
        if (index === -1) {
            alert('Libro no encontrado.');
            return false;
        }

        const existingChapters = Array.isArray(books[index].chapters) ? books[index].chapters : [];
        const nextChapterNumber = existingChapters.length + 1;

        await editorApi(`/biblioteca/libros/${selectedExistingBookId}/asignaciones`, {
            method: 'POST',
            body: JSON.stringify({
                chapter_number: nextChapterNumber,
                chapter_title: chapterName,
                text_content: getEditorContentText(),
                html_content: content,
            }),
        });

        await loadEditorLibraryBooks();
        return true;
    }

    async function saveFromEditorModal() {
        const content = getEditorContentHtml();
        if (!content) {
            alert('La nota está vacía.');
            return;
        }

        let ok = false;
        try {
            ok = currentSaveTarget === 'note'
                ? await saveAsFileNote(content)
                : await saveAsBookChapter(content);
        } catch (error) {
            alert(error.message || 'No se pudo guardar.');
            return;
        }

        if (!ok) return;

        closeSaveModal();
        removeCurrentDraftIfExists();
        startBlankDraft();
        alert(currentSaveTarget === 'note'
            ? 'Nota guardada en Archivos correctamente.'
            : 'Capítulo guardado en Biblioteca correctamente.');
    }

    function sendEditorMessage(type, extra = {}) {
        const payload = { app: 'editor', type, ...extra };
        if (window.parent && window.parent !== window) {
            window.parent.postMessage(payload, '*');
        } else {
            window.postMessage(payload, '*');
        }
    }

    function openEditorFloating() {
        const safeWidth = Math.max(EDITOR_MIN_WIDTH, Math.floor(window.innerWidth * 0.9));
        const safeHeight = Math.max(EDITOR_MIN_HEIGHT, Math.floor((window.innerHeight - 72) * 0.84));

        isEditorMaximized = false;
        editorWindow.classList.remove('maximized');
        editorWindow.style.display = 'flex';
        editorWindow.style.position = 'fixed';
        editorWindow.style.width = safeWidth + 'px';
        editorWindow.style.height = safeHeight + 'px';
        editorWindow.style.top = Math.max(0, Math.floor((window.innerHeight - 72 - safeHeight) / 2)) + 'px';
        editorWindow.style.left = '50%';
        editorWindow.style.right = 'auto';
        editorWindow.style.bottom = 'auto';
        editorWindow.style.transform = 'translateX(-50%)';
        editorWindow.style.borderRadius = '1rem';
        editorWindow.style.resize = 'both';

        const btn = document.querySelector('#editorModal .maximize-btn');
        if (btn) btn.innerHTML = '<i class="fas fa-square"></i>';

        loadEditorDrafts().catch(err => console.error('Error loading drafts on open:', err));
    }

    function openEditorMaximized() {
        isEditorMaximized = true;
        editorWindow.classList.add('maximized');
        editorWindow.style.display = 'flex';
        editorWindow.style.position = 'fixed';
        editorWindow.style.width = '100%';
        editorWindow.style.height = 'calc(100vh - 72px)';
        editorWindow.style.top = '0';
        editorWindow.style.left = '0';
        editorWindow.style.right = 'auto';
        editorWindow.style.bottom = 'auto';
        editorWindow.style.transform = 'none';
        editorWindow.style.borderRadius = '0';
        editorWindow.style.resize = 'none';

        const btn = document.querySelector('#editorModal .maximize-btn');
        if (btn) btn.innerHTML = '<i class="fas fa-window-restore"></i>';
    }

    function clampEditorIntoViewport() {
        if (isEditorMaximized) return;

        const rect = editorWindow.getBoundingClientRect();
        let left = rect.left;
        let top = rect.top;
        const maxLeft = Math.max(0, window.innerWidth - rect.width);
        const maxTop = Math.max(0, (window.innerHeight - 72) - rect.height);

        left = Math.max(0, Math.min(left, maxLeft));
        top = Math.max(0, Math.min(top, maxTop));

        editorWindow.style.left = left + 'px';
        editorWindow.style.top = top + 'px';
        editorWindow.style.transform = 'none';
    }

    editorHeader.addEventListener('mousedown', (event) => {
        if (event.target.closest('.editor-controls') || isEditorMaximized) return;
        isEditorDragging = true;
        sendEditorMessage('focus');
        const rect = editorWindow.getBoundingClientRect();
        editorDragOffsetX = event.clientX - rect.left;
        editorDragOffsetY = event.clientY - rect.top;
    });

    document.addEventListener('mousemove', (event) => {
        if (isEditorDragging && !isEditorMaximized) {
            const rect = editorWindow.getBoundingClientRect();
            const maxLeft = Math.max(0, window.innerWidth - rect.width);
            const maxTop = Math.max(0, (window.innerHeight - 72) - rect.height);
            const newLeft = Math.max(0, Math.min(event.clientX - editorDragOffsetX, maxLeft));
            const newTop = Math.max(0, Math.min(event.clientY - editorDragOffsetY, maxTop));
            editorWindow.style.left = newLeft + 'px';
            editorWindow.style.top = newTop + 'px';
            editorWindow.style.transform = 'none';
        }

        if (isEditorResizing && !isEditorMaximized) {
            const rect = editorWindow.getBoundingClientRect();
            const maxWidth = Math.max(EDITOR_MIN_WIDTH, window.innerWidth - rect.left);
            const maxHeight = Math.max(EDITOR_MIN_HEIGHT, (window.innerHeight - 72) - rect.top);
            const newWidth = Math.min(maxWidth, Math.max(EDITOR_MIN_WIDTH, editorStartWidth + (event.clientX - editorStartX)));
            const newHeight = Math.min(maxHeight, Math.max(EDITOR_MIN_HEIGHT, editorStartHeight + (event.clientY - editorStartY)));
            editorWindow.style.width = newWidth + 'px';
            editorWindow.style.height = newHeight + 'px';
        }
    });

    document.addEventListener('mouseup', () => {
        isEditorDragging = false;
        isEditorResizing = false;
    });

    editorResizeHandle.addEventListener('mousedown', (event) => {
        if (isEditorMaximized) return;
        isEditorResizing = true;
        sendEditorMessage('focus');
        const rect = editorWindow.getBoundingClientRect();
        editorStartX = event.clientX;
        editorStartY = event.clientY;
        editorStartWidth = rect.width;
        editorStartHeight = rect.height;
    });

    function minimizeEditor(event) {
        if (event) event.stopPropagation();
        sendEditorMessage('minimize', { mode: isEditorMaximized ? 'maximized' : 'floating' });
    }

    function toggleMaximizeEditor(event) {
        if (event) event.stopPropagation();
        sendEditorMessage('focus');
        isEditorMaximized = !isEditorMaximized;
        if (isEditorMaximized) {
            openEditorMaximized();
            sendEditorMessage('maximize');
        } else {
            openEditorFloating();
            sendEditorMessage('restore');
        }
    }

    function closeEditor(event) {
        if (event) event.stopPropagation();
        sendEditorMessage('close');
    }

    function execCmd(command) {
        document.getElementById('editorRichContent')?.focus();
        document.execCommand(command, false, null);
    }

    function getEditorContentHtml() {
        const html = document.getElementById('editorRichContent')?.innerHTML || '';
        const onlyBreak = html.replace(/<br\s*\/?>/gi, '').replace(/&nbsp;/gi, '').trim();
        return onlyBreak ? html : '';
    }

    function getEditorContentText() {
        return (document.getElementById('editorRichContent')?.innerText || '').trim();
    }

    function newNote() {
        startBlankDraft();
    }

    function saveNote() {
        openSaveModal();
    }

    window.addEventListener('message', (event) => {
        if (!event.data || !event.data.type) return;
        if (event.data.app && event.data.app !== 'editor') return;

        if (event.data.type === 'openFloating') {
            openEditorFloating();
        } else if (event.data.type === 'openMaximized') {
            openEditorMaximized();
        } else if (event.data.type === 'openChapter') {
            openChapterInEditorContent(event.data);
        }
    });

    window.addEventListener('resize', clampEditorIntoViewport);

    window.addEventListener('load', () => {
        const params = new URLSearchParams(window.location.search);
        const queryBookId = params.get('bookId');
        const queryChapterId = params.get('chapterId');
        if (queryBookId && queryChapterId) {
            openChapterInEditorContent({
                bookId: queryBookId,
                chapterId: queryChapterId,
            });
            return;
        }

        const editor = document.getElementById('editorRichContent');
        if (editor) {
            editor.addEventListener('input', () => {
                if (editorDraftSaveTimeout) clearTimeout(editorDraftSaveTimeout);
                editorDraftSaveTimeout = setTimeout(async () => {
                    await persistCurrentContentAsDraft();
                }, 700);
            });
        }
    });

    editorWindow.addEventListener('mousedown', () => sendEditorMessage('focus'));

    window.TextEditorApp = {
        openFloating: openEditorFloating,
        openMaximized: openEditorMaximized,
    };
</script>
