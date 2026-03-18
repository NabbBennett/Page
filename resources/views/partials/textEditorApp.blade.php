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
        display: flex;
        align-items: center;
        gap: 0.75rem;
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
            <button class="new-btn" onclick="newNote()">
                <i class="fas fa-plus"></i>
                <span>Nueva</span>
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
    const FILES_STORAGE_KEY_EDITOR = `files_app_v1_${EDITOR_USER_ROLE}`;
    const LIBRARY_STORAGE_KEY_EDITOR = `library_books_v1_${EDITOR_USER_ROLE}`;
    const EDITOR_NOTE_FALLBACK_KEY = 'editorNote';

    const editorWindow = document.getElementById('editorWindow');
    const editorHeader = document.getElementById('editorHeader');
    const editorResizeHandle = document.getElementById('resizeHandle');

    let currentSaveTarget = 'note';
    let currentBookMode = 'new';
    let selectedSaveFolderId = null;
    let selectedExistingBookId = null;

    const defaultEditorFilesData = {
        folders: [
            { id: 'folder-1', name: 'Dribbble' },
            { id: 'folder-2', name: 'Behance' },
            { id: 'folder-3', name: 'Artstation' },
        ],
        files: [],
    };

    const defaultEditorLibraryBooks = [
        {
            id: 'book-1',
            title: 'Tun',
            author: 'Sebastian',
            synopsis: 'Primer libro en la colección.',
            status: 'En emisión',
            totalChapters: 1,
            currentChapter: 0,
            cover: 'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=600&q=80',
            chapters: [],
        }
    ];

    function escapeEditorHtml(text) {
        return (text || '')
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#39;');
    }

    function getEditorFilesData() {
        const raw = localStorage.getItem(FILES_STORAGE_KEY_EDITOR);
        if (!raw) {
            localStorage.setItem(FILES_STORAGE_KEY_EDITOR, JSON.stringify(defaultEditorFilesData));
            return JSON.parse(JSON.stringify(defaultEditorFilesData));
        }
        return JSON.parse(raw);
    }

    function setEditorFilesData(data) {
        localStorage.setItem(FILES_STORAGE_KEY_EDITOR, JSON.stringify(data));
    }

    function getEditorLibraryBooks() {
        const raw = localStorage.getItem(LIBRARY_STORAGE_KEY_EDITOR);
        if (!raw) {
            localStorage.setItem(LIBRARY_STORAGE_KEY_EDITOR, JSON.stringify(defaultEditorLibraryBooks));
            return JSON.parse(JSON.stringify(defaultEditorLibraryBooks));
        }
        return JSON.parse(raw);
    }

    function setEditorLibraryBooks(items) {
        localStorage.setItem(LIBRARY_STORAGE_KEY_EDITOR, JSON.stringify(items));
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

    function openSaveModal() {
        const content = getEditorContentText();
        if (!content) {
            alert('La nota está vacía. Escribe algo antes de guardar.');
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

    function saveAsFileNote(content) {
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

        const filesData = getEditorFilesData();
        filesData.files.push({
            id: `file-${Date.now()}`,
            folderId: selectedSaveFolderId,
            name: noteName,
            image: 'https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=900&q=80',
            password: encrypted ? password : null,
            kind: 'note',
            textContent: getEditorContentText(),
            htmlContent: content,
        });
        setEditorFilesData(filesData);
        localStorage.setItem(EDITOR_NOTE_FALLBACK_KEY, content);
        return true;
    }

    function saveAsBookChapter(content) {
        const books = getEditorLibraryBooks();

        if (currentBookMode === 'new') {
            const title = document.getElementById('saveBookTitleInput').value.trim();
            const author = document.getElementById('saveBookAuthorInput').value.trim();
            const firstChapterName = document.getElementById('saveBookFirstChapterInput').value.trim();

            if (!title || !author || !firstChapterName) {
                alert('Completa título, autor y nombre del primer capítulo.');
                return false;
            }

            books.push({
                id: `book-${Date.now()}`,
                title,
                author,
                synopsis: '',
                status: 'En emisión',
                totalChapters: 1,
                currentChapter: 0,
                cover: 'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=600&q=80',
                chapters: [{
                    id: `chapter-${Date.now()}`,
                    title: firstChapterName,
                    content,
                    createdAt: new Date().toISOString(),
                }],
            });

            setEditorLibraryBooks(books);
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
        existingChapters.push({
            id: `chapter-${Date.now()}`,
            title: chapterName,
            content,
            createdAt: new Date().toISOString(),
        });

        books[index] = {
            ...books[index],
            chapters: existingChapters,
            totalChapters: Math.max(1, Number(books[index].totalChapters || 0) + 1),
        };

        setEditorLibraryBooks(books);
        return true;
    }

    function saveFromEditorModal() {
        const content = getEditorContentHtml();
        if (!content) {
            alert('La nota está vacía.');
            return;
        }

        const ok = currentSaveTarget === 'note'
            ? saveAsFileNote(content)
            : saveAsBookChapter(content);

        if (!ok) return;

        closeSaveModal();
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

    function showNotes() {
        alert('Notas: Funcionalidad en desarrollo');
    }

    function newNote() {
        const editor = document.getElementById('editorRichContent');
        if (editor) editor.innerHTML = '';
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
        }
    });

    window.addEventListener('resize', clampEditorIntoViewport);

    window.addEventListener('load', () => {
        const savedNote = localStorage.getItem(EDITOR_NOTE_FALLBACK_KEY);
        if (savedNote) {
            document.getElementById('editorRichContent').innerHTML = savedNote;
        }
    });

    editorWindow.addEventListener('mousedown', () => sendEditorMessage('focus'));

    window.TextEditorApp = {
        openFloating: openEditorFloating,
        openMaximized: openEditorMaximized,
    };
</script>
