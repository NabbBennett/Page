<style>
	#libraryModal .library-window {
		position: fixed;
		top: 50px;
		left: 50%;
		transform: translateX(-50%);
		width: 90vw;
		height: 84vh;
		display: flex;
		flex-direction: column;
		border: 1px solid #5a5250;
		border-radius: 1rem;
		overflow: hidden;
		background: #E2D8CC;
		box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
		resize: both;
		user-select: none;
		pointer-events: auto;
		color: #443C3D;
	}

	#libraryModal .library-window.maximized {
		top: 0;
		left: 0;
		width: 100%;
		height: calc(100vh - 72px);
		transform: none;
		border-radius: 0;
		resize: none;
	}

	#libraryModal .window-header {
		height: 52px;
		background: #443C3D;
		color: #E2D8CC;
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 0 16px;
		cursor: move;
	}

	#libraryModal .window-title {
		display: flex;
		align-items: center;
		gap: 10px;
		font-weight: 700;
	}

	#libraryModal .window-controls {
		display: flex;
		gap: 10px;
	}

	#libraryModal .window-btn {
		width: 28px;
		height: 28px;
		border: none;
		border-radius: 6px;
		background: rgba(255, 255, 255, 0.2);
		color: #E2D8CC;
		cursor: pointer;
	}

	#libraryModal .window-btn:hover { background: rgba(255, 255, 255, 0.35); }
	#libraryModal .window-btn.close:hover { background: #9b2f2f; }

	#libraryModal .resize-handle {
		position: absolute;
		bottom: 0;
		right: 0;
		width: 20px;
		height: 20px;
		cursor: se-resize;
		background: linear-gradient(135deg, transparent 50%, #443C3D 50%);
		opacity: 0.35;
	}

	#libraryModal .library-window.maximized .resize-handle { display: none; }

	#libraryModal .library-body {
		flex: 1;
		overflow: auto;
	}

	#libraryModal .library-toolbar {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 18px 22px;
		border-bottom: 2px solid #5a5250;
	}

	#libraryModal .library-title-wrap h2 {
		font-size: 2rem;
		line-height: 1;
		font-weight: 800;
	}

	#libraryModal .muted {
		color: #7a7172;
		font-size: 0.95rem;
	}

	#libraryModal .primary-btn {
		border: none;
		border-radius: 14px;
		background: #443C3D;
		color: #E2D8CC;
		padding: 10px 18px;
		font-weight: 700;
		cursor: pointer;
		font-size: 1rem;
	}

	#libraryModal .ghost-btn {
		border: 2px solid #5a5250;
		border-radius: 14px;
		background: #fff;
		color: #443C3D;
		padding: 10px 18px;
		font-weight: 700;
		cursor: pointer;
		font-size: 1rem;
	}

	#libraryModal .danger-btn {
		border: 2px solid #9b2f2f;
		border-radius: 14px;
		background: #fff;
		color: #9b2f2f;
		padding: 10px 18px;
		font-weight: 700;
		cursor: pointer;
		font-size: 1rem;
	}

	#libraryModal .library-grid {
		padding: 20px;
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
		gap: 18px;
		align-items: start;
	}

	#libraryModal .book-card {
		cursor: pointer;
		text-align: center;
	}

	#libraryModal .book-cover {
		width: 130px;
		height: 190px;
		border: 3px solid #5a5250;
		border-radius: 14px;
		object-fit: cover;
		margin: 0 auto 10px;
		background: #d8d2ca;
	}

	#libraryModal .book-title {
		font-size: 1.15rem;
		font-weight: 800;
	}

	#libraryModal .book-author {
		color: #7a7172;
		font-size: 0.95rem;
		margin-top: 2px;
	}

	#libraryModal .status-badge {
		display: inline-block;
		margin-top: 6px;
		padding: 4px 10px;
		border-radius: 999px;
		border: 1px solid #5a5250;
		font-size: 0.8rem;
		font-weight: 700;
		background: #D0C4B4;
	}

	#libraryModal .status-inline {
		margin-top: 10px;
		display: inline-flex;
		align-items: center;
		gap: 8px;
	}

	#libraryModal .detail-wrap {
		padding: 18px 20px;
	}

	#libraryModal .detail-top-actions {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 14px;
	}

	#libraryModal .detail-main {
		display: grid;
		grid-template-columns: 180px 1fr;
		gap: 16px;
		margin-bottom: 16px;
	}

	#libraryModal .detail-cover {
		width: 180px;
		height: 100%;
		border: 3px solid #5a5250;
		border-radius: 14px;
		object-fit: cover;
		background: #d8d2ca;
	}

	#libraryModal .progress-box {
		border: 2px solid #5a5250;
		border-radius: 14px;
		padding: 14px;
		background: #f2f2f2;
		margin-top: 12px;
	}

	#libraryModal .progress-track {
		width: 100%;
		height: 12px;
		border-radius: 999px;
		background: #d0c4b4;
		overflow: hidden;
		margin-top: 8px;
	}

	#libraryModal .progress-fill {
		height: 100%;
		background: #443C3D;
		width: 0;
		transition: width 0.2s;
	}

	#libraryModal .card-block {
		background: #f2f2f2;
		border: 2px solid #5a5250;
		border-radius: 16px;
		padding: 18px;
		margin-top: 14px;
	}

	#libraryModal .chapter-item {
		display: grid;
		grid-template-columns: 1fr auto;
		align-items: center;
		gap: 10px;
		padding: 14px 16px;
		border: 2px solid #5a5250;
		border-radius: 14px;
		background: #E2D8CC;
		margin-top: 10px;
		cursor: pointer;
	}

	#libraryModal .chapter-item:hover {
		background: #d8cec2;
	}

	#libraryModal .chapter-actions {
		display: inline-flex;
		align-items: center;
		gap: 8px;
	}

	#libraryModal .chapter-edit-btn {
		border: none;
		border-radius: 12px;
		background: #443C3D;
		color: #E2D8CC;
		padding: 8px 14px;
		font-weight: 700;
		cursor: pointer;
	}

	#libraryModal .chapter-delete-btn {
		border: none;
		background: transparent;
		color: #ff4a4a;
		cursor: pointer;
		font-size: 1.05rem;
	}

	#libraryModal .reader-shell {
		height: 100%;
		display: flex;
		flex-direction: column;
	}

	#libraryModal .reader-top {
		display: grid;
		grid-template-columns: auto 1fr auto;
		align-items: center;
		gap: 12px;
		padding: 12px 16px;
		border-bottom: 2px solid #5a5250;
	}

	#libraryModal .reader-title {
		text-align: center;
		font-weight: 800;
	}

	#libraryModal .reader-body {
		flex: 1;
		overflow: auto;
		padding: 22px 24px;
	}

	#libraryModal .reader-layout {
		flex: 1;
		display: grid;
		grid-template-columns: 1fr auto;
		min-height: 0;
		overflow: hidden;
	}

	#libraryModal .reader-main {
		min-width: 0;
		overflow: auto;
	}

	#libraryModal .reader-content {
		font-size: 1.05rem;
		line-height: 1.6;
		border-top: 2px solid #c5b9ab;
		padding-top: 16px;
		margin-top: 10px;
	}

	#libraryModal .reader-bottom {
		border-top: 2px solid #5a5250;
		padding: 16px;
		display: grid;
		grid-template-columns: 1fr auto 1fr;
		align-items: center;
		gap: 12px;
	}

	#libraryModal .reader-nav-btn {
		border: none;
		border-radius: 14px;
		padding: 12px 20px;
		font-weight: 800;
		background: #443C3D;
		color: #E2D8CC;
		cursor: pointer;
	}

	#libraryModal .reader-nav-btn[disabled] {
		background: #c5b9ab;
		color: #f2f2f2;
		cursor: not-allowed;
	}

	#libraryModal .reader-caps {
		width: 0;
		overflow: hidden;
		border-left: 0 solid #5a5250;
		background: #443C3D;
		padding: 0;
		transition: width 0.2s ease, border-left-width 0.2s ease, padding 0.2s ease;
	}

	#libraryModal .reader-caps.active {
		width: 300px;
		border-left-width: 2px;
		padding: 12px;
	}

	#libraryModal .reader-cap-btn {
		width: 100%;
		text-align: left;
		border: 2px solid #5a5250;
		border-radius: 10px;
		background: #E2D8CC;
		padding: 10px 12px;
		font-weight: 700;
		margin-top: 8px;
		cursor: pointer;
	}

	#libraryModal .reader-cap-btn.active {
		background: #D0C4B4;
	}

	#libraryModal .reader-caps-title {
		font-size: 1.2rem;
		font-weight: 800;
		margin-bottom: 4px;
	}

	#libraryModal .modal-backdrop {
		position: fixed;
		inset: 0;
		background: rgba(0,0,0,0.45);
		display: none;
		align-items: center;
		justify-content: center;
		z-index: 2200;
		pointer-events: auto;
	}

	#libraryModal .modal-backdrop.active { display: flex; }

	#libraryModal .modal-box {
		width: min(780px, calc(100% - 24px));
		max-height: calc(100% - 24px);
		overflow: auto;
		background: #E2D8CC;
		border: 2px solid #5a5250;
		border-radius: 16px;
		padding: 18px;
	}

	#libraryModal .modal-head {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 12px;
	}

	#libraryModal .input,
	#libraryModal .textarea,
	#libraryModal .select {
		width: 100%;
		border: 2px solid #5a5250;
		border-radius: 12px;
		background: #f2f2f2;
		color: #443C3D;
		padding: 10px 12px;
		margin-top: 6px;
		outline: none;
		font-size: 1rem;
	}

	#libraryModal .textarea { min-height: 110px; resize: vertical; }

	#libraryModal .row-2 {
		display: grid;
		grid-template-columns: 1fr 1fr;
		gap: 12px;
	}

	#libraryModal .modal-actions {
		display: grid;
		grid-template-columns: 1fr 1fr;
		gap: 10px;
		margin-top: 14px;
	}

	#libraryModal .modal-actions-3 {
		display: grid;
		grid-template-columns: 1fr 1fr;
		gap: 10px;
		margin-top: 14px;
	}

	#libraryModal .hidden-file-input { display: none; }

	#libraryModal .upload-zone {
		margin-top: 8px;
		border: 2px dashed #5a5250;
		border-radius: 14px;
		background: #D0C4B4;
		min-height: 130px;
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
		overflow: hidden;
	}

	#libraryModal #libraryCoverZone {
		min-height: 260px;
	}

	#libraryModal .upload-zone-content {
		text-align: center;
		color: #7a7172;
	}

	#libraryModal .upload-zone-content i { font-size: 1.4rem; }

	#libraryModal .upload-preview {
		display: none;
		width: 100%;
		height: 180px;
		object-fit: cover;
	}

	#libraryModal #libraryCoverZone .upload-preview {
		width: 180px;
		height: 240px;
		border: 2px solid #5a5250;
		border-radius: 10px;
	}

	#libraryModal .upload-zone.has-preview .upload-preview { display: block; }
	#libraryModal .upload-zone.has-preview .upload-zone-content { display: none; }
</style>

<div class="library-window" id="libraryWindow">
	<div class="window-header">
		<div class="window-title">
			<i class="fa-solid fa-book"></i>
			<span>Biblioteca</span>
		</div>
		<div class="window-controls">
			<button class="window-btn" type="button" onclick="minimizeLibrary()"><i class="fa-solid fa-minus"></i></button>
			<button class="window-btn" type="button" onclick="toggleMaximizeLibrary()" id="libraryMaxBtn"><i class="fa-regular fa-square"></i></button>
			<button class="window-btn close" type="button" onclick="closeLibrary()"><i class="fa-solid fa-xmark"></i></button>
		</div>
	</div>

	<div class="library-body" id="libraryBody"></div>
	<div class="resize-handle" id="libraryResizeHandle"></div>
</div>

<div class="modal-backdrop" id="libraryFormModal">
	<div class="modal-box">
		<div class="modal-head">
			<h3 id="libraryFormTitle" style="font-size: 1.4rem; font-weight: 800;">Crear nuevo libro</h3>
			<button type="button" class="window-btn close" onclick="closeLibraryForm()"><i class="fa-solid fa-xmark"></i></button>
		</div>

		<label style="font-weight:700; font-size: 1rem;">Portada</label>
		<input class="hidden-file-input" type="file" id="libraryCoverInput" accept="image/*" />
		<div class="upload-zone" id="libraryCoverZone" onclick="triggerLibraryFileInput()">
			<img id="libraryCoverPreview" class="upload-preview" alt="Vista previa portada">
			<div class="upload-zone-content">
				<i class="fa-solid fa-upload"></i>
				<div>Sube la portada</div>
			</div>
		</div>

		<div style="margin-top: 12px;">
			<label style="font-weight:700; font-size: 1rem;">Título *</label>
			<input class="input" id="libraryTitleInput" placeholder="Título del libro" />
		</div>

		<div style="margin-top: 12px;">
			<label style="font-weight:700; font-size: 1rem;">Autor *</label>
			<input class="input" id="libraryAuthorInput" placeholder="Nombre del autor" />
		</div>

		<div style="margin-top: 12px;">
			<label style="font-weight:700; font-size: 1rem;">Sinopsis</label>
			<textarea class="textarea" id="librarySynopsisInput" placeholder="Breve descripción..."></textarea>
		</div>

		<div style="margin-top: 12px;">
			<label style="font-weight:700; font-size: 1rem;">Estado</label>
			<select class="select" id="libraryStatusInput">
				<option value="En emisión">En emisión</option>
				<option value="Cancelado">Cancelado</option>
				<option value="Terminado">Terminado</option>
			</select>
		</div>

		<div class="modal-actions" id="libraryCreateActions">
			<button type="button" class="ghost-btn" onclick="closeLibraryForm()">Cancelar</button>
			<button type="button" class="primary-btn" onclick="saveLibraryBook()">Guardar libro</button>
		</div>

		<div class="modal-actions-3" id="libraryEditActions" style="display:none;">
			<button type="button" class="ghost-btn" onclick="closeLibraryForm()">Cancelar</button>
			<button type="button" class="primary-btn" onclick="saveLibraryBook()">Guardar cambios</button>
		</div>
	</div>
</div>

<script>
	const LIBRARY_MIN_WIDTH = 320;
	const LIBRARY_MIN_HEIGHT = 240;
	const LIBRARY_USER_ROLE = @json($userType ?? 'guest');
	const LIBRARY_STORAGE_KEY = `library_books_v1_${LIBRARY_USER_ROLE}`;

	let isLibraryMaximized = false;
	let isLibraryDragging = false;
	let isLibraryResizing = false;
	let libraryDragOffsetX = 0;
	let libraryDragOffsetY = 0;
	let libraryStartX = 0;
	let libraryStartY = 0;
	let libraryStartW = 0;
	let libraryStartH = 0;
	let editingLibraryBookId = null;
	let libraryCurrentBookId = null;

	const libraryWindow = document.getElementById('libraryWindow');
	const libraryResizeHandle = document.getElementById('libraryResizeHandle');
	const libraryHeader = libraryWindow.querySelector('.window-header');

	const defaultLibraryBooks = [
		{
			id: 'book-1',
			title: 'Tun',
			author: 'Sebastian',
			synopsis: 'Primer libro en la colección.',
			status: 'En emisión',
			totalChapters: 1,
			currentChapter: 0,
			cover: 'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=600&q=80'
		}
	];

	function sendLibraryMessage(type, extra = {}) {
		const payload = { app: 'library', type, ...extra };
		if (window.parent && window.parent !== window) {
			window.parent.postMessage(payload, '*');
		} else {
			window.postMessage(payload, '*');
		}
	}

	function getLibraryBooks() {
		const raw = localStorage.getItem(LIBRARY_STORAGE_KEY);
		if (!raw) {
			const normalizedDefaults = normalizeLibraryBooks(defaultLibraryBooks);
			localStorage.setItem(LIBRARY_STORAGE_KEY, JSON.stringify(normalizedDefaults));
			return normalizedDefaults;
		}

		const parsed = normalizeLibraryBooks(JSON.parse(raw));
		localStorage.setItem(LIBRARY_STORAGE_KEY, JSON.stringify(parsed));
		return parsed;
	}

	function setLibraryBooks(items) {
		localStorage.setItem(LIBRARY_STORAGE_KEY, JSON.stringify(items));
	}

	function escapeLibraryHtml(text) {
		return (text || '')
			.replaceAll('&', '&amp;')
			.replaceAll('<', '&lt;')
			.replaceAll('>', '&gt;')
			.replaceAll('"', '&quot;')
			.replaceAll("'", '&#39;');
	}

	function getBookChapters(book) {
		return Array.isArray(book?.chapters) ? book.chapters : [];
	}

	function normalizeLibraryBooks(items) {
		if (!Array.isArray(items)) return [];
		return items.map(item => {
			const chapters = Array.isArray(item?.chapters) ? item.chapters : [];
			const safeTotal = Math.max(1, Number(item?.totalChapters || chapters.length || 1));
			const safeCurrent = Math.max(0, Math.min(safeTotal, Number(item?.currentChapter || 0)));
			return {
				...item,
				chapters,
				totalChapters: safeTotal,
				currentChapter: safeCurrent,
			};
		});
	}

	function libraryIsAdmin() {
		return LIBRARY_USER_ROLE === 'admin';
	}

	function libraryProgressPercent(book) {
		const total = Math.max(1, Number(book.totalChapters || 1));
		const current = Math.max(0, Math.min(total, Number(book.currentChapter || 0)));
		return Math.round((current / total) * 100);
	}

	function renderLibraryHome() {
		libraryCurrentBookId = null;
		const books = getLibraryBooks();
		const body = document.getElementById('libraryBody');

		body.innerHTML = `
			<div class="library-toolbar">
				<div class="library-title-wrap">
					<h2><i class="fa-solid fa-book"></i> Mi Biblioteca</h2>
					<div class="muted">${books.length} libro${books.length === 1 ? '' : 's'} en la colección</div>
				</div>
				<button type="button" class="primary-btn" onclick="openLibraryCreateModal()"><i class="fa-solid fa-plus"></i> Crear libro</button>
			</div>
			<div class="library-grid">
				${books.map(book => `
					<div class="book-card" onclick="openLibraryDetail('${book.id}')">
						<img class="book-cover" src="${book.cover || ''}" alt="cover" />
						<div class="book-title">${escapeLibraryHtml(book.title)}</div>
						<div class="book-author">${escapeLibraryHtml(book.author)}</div>
						<span class="status-badge">${escapeLibraryHtml(book.status)}</span>
						<div class="muted" style="margin-top: 4px;">${book.totalChapters || 1} cap.</div>
					</div>
				`).join('')}
			</div>
		`;
	}

	function openLibraryDetail(bookId) {
		const books = getLibraryBooks();
		const book = books.find(item => item.id === bookId);
		if (!book) return;

		libraryCurrentBookId = bookId;
		const progress = libraryProgressPercent(book);
		const chapters = getReadableChapters(book);
		const canManageChapters = libraryIsAdmin();
		const body = document.getElementById('libraryBody');
		body.innerHTML = `
			<div class="library-toolbar" style="padding:14px 20px;">
				<button type="button" class="ghost-btn" onclick="renderLibraryHome()"><i class="fa-solid fa-arrow-left"></i> Biblioteca</button>
				<div style="display:flex; gap:10px;">
					<button type="button" class="primary-btn" style="background:#e67e00;" onclick="openLibraryEditModal('${book.id}')"><i class="fa-solid fa-pen"></i> Editar libro</button>
					<button type="button" class="danger-btn" onclick="confirmDeleteLibraryBook('${book.id}')"><i class="fa-solid fa-trash"></i> Eliminar</button>
				</div>
			</div>

			<div class="detail-wrap">
				<div class="detail-main">
					<div>
						<img class="detail-cover" src="${book.cover || ''}" alt="cover">
					</div>
					<div>
						<h2 style="font-size:2.2rem; font-weight:800; line-height:1.1;">${escapeLibraryHtml(book.title)}</h2>
						<div style="font-size:1.05rem; color:#7a7172; margin-top:4px;">por ${escapeLibraryHtml(book.author)}</div>
						<div class="status-inline">
							<i class="fa-solid fa-circle-info" style="color:#7a7172;"></i>
							<span class="status-badge" style="margin-top:0;">${escapeLibraryHtml(book.status)}</span>
						</div>

						<div class="progress-box">
							<div style="display:flex; justify-content:space-between; font-weight:700;">
								<span>Progreso de lectura</span>
								<span>${progress}%</span>
							</div>
							<div class="progress-track"><div class="progress-fill" style="width:${progress}%"></div></div>
							<div class="muted" style="margin-top:6px;">Capítulo ${book.currentChapter || 0} de ${book.totalChapters || 1}</div>
						</div>

						<button type="button" class="ghost-btn" style="width:100%; margin-top:12px;" onclick="startReading('${book.id}')">
							<i class="fa-solid fa-book-open"></i> ${progress === 0 ? 'Comenzar a leer' : 'Continuar leyendo'}
						</button>
					</div>
				</div>

				<div class="card-block">
					<h3 style="font-size:2rem; font-weight:800; margin-bottom:8px;">Sinopsis</h3>
					<div>${escapeLibraryHtml(book.synopsis || 'Sin descripción aún.')}</div>
				</div>

				<div class="card-block">
					<h3 style="font-size:2rem; font-weight:800; margin-bottom:8px;">Capítulos (${chapters.length})</h3>
					${chapters.length === 0
						? '<div class="muted">Este libro aún no tiene capítulos guardados.</div>'
						: chapters.map((chapter, index) => `
							<div class="chapter-item" onclick="openLibraryReader('${book.id}', ${index + 1})">
								<div style="font-size:1.5rem; font-weight:700;"><i class="fa-solid fa-chevron-right" style="font-size:0.95rem; margin-right:8px;"></i>Cap. ${index + 1}: ${escapeLibraryHtml(chapter.title || `Capítulo ${index + 1}`)}</div>
								<div class="chapter-actions">
									${!String(chapter.id || '').startsWith('fallback-')
										? `<button type="button" class="chapter-edit-btn" onclick="event.stopPropagation(); openChapterInEditor('${book.id}', '${chapter.id}')"><i class="fa-solid fa-pen"></i> Editar</button>`
										: ''}
									${canManageChapters && !String(chapter.id || '').startsWith('fallback-')
										? `<button type="button" class="chapter-delete-btn" onclick="event.stopPropagation(); deleteLibraryChapter('${book.id}', '${chapter.id}')"><i class="fa-solid fa-trash"></i></button>`
										: ''}
								</div>
							</div>
						`).join('')}
				</div>
			</div>
		`;
	}

	function openChapterInEditor(bookId, chapterId) {
		const books = getLibraryBooks();
		const book = books.find(item => item.id === bookId);
		if (!book) return;

		const chapter = getBookChapters(book).find(item => item.id === chapterId);
		if (!chapter) {
			alert('Capítulo no encontrado.');
			return;
		}

		if (typeof window.openTextEditor === 'function') {
			window.openTextEditor();
			window.postMessage({
				app: 'editor',
				type: 'openChapter',
				bookId,
				chapterId,
				chapterTitle: chapter.title || '',
				content: chapter.content || '',
			}, '*');
			return;
		}

		const editorUrl = new URL('/text-editor', window.location.origin);
		editorUrl.searchParams.set('bookId', bookId);
		editorUrl.searchParams.set('chapterId', chapterId);
		window.location.href = editorUrl.toString();
	}

	function deleteLibraryChapter(bookId, chapterId) {
		if (!libraryIsAdmin()) return;
		if (!confirm('¿Eliminar este capítulo?')) return;

		const books = getLibraryBooks();
		const index = books.findIndex(item => item.id === bookId);
		if (index === -1) return;

		const currentChapters = getBookChapters(books[index]);
		const nextChapters = currentChapters.filter(item => item.id !== chapterId);
		const nextTotal = Math.max(1, nextChapters.length);

		books[index] = {
			...books[index],
			chapters: nextChapters,
			totalChapters: nextTotal,
			currentChapter: Math.max(0, Math.min(Number(books[index].currentChapter || 0), nextTotal)),
		};

		setLibraryBooks(books);
		openLibraryDetail(bookId);
	}

	function getReadableChapters(book) {
		const chapters = getBookChapters(book);
		if (chapters.length > 0) return chapters;

		const fallbackTotal = Math.max(1, Number(book.totalChapters || 1));
		return Array.from({ length: fallbackTotal }, (_, index) => ({
			id: `fallback-${book.id}-${index + 1}`,
			title: `Capítulo ${index + 1}`,
			content: '',
		}));
	}

	function updateBookCurrentChapter(bookId, chapterNumber) {
		const books = getLibraryBooks();
		const index = books.findIndex(item => item.id === bookId);
		if (index === -1) return;

		const chaptersLen = getReadableChapters(books[index]).length;
		books[index] = {
			...books[index],
			totalChapters: Math.max(1, chaptersLen),
			currentChapter: Math.max(1, Math.min(chaptersLen, chapterNumber)),
		};

		setLibraryBooks(books);
	}

	function toggleReaderCaps() {
		const panel = document.getElementById('libraryReaderCaps');
		if (!panel) return;
		panel.classList.toggle('active');
	}

	function openLibraryReader(bookId, chapterNumber = null) {
		const books = getLibraryBooks();
		const book = books.find(item => item.id === bookId);
		if (!book) return;

		const chapters = getReadableChapters(book);
		const fallbackCurrent = Number(book.currentChapter || 0) > 0 ? Number(book.currentChapter) : 1;
		const requested = Number(chapterNumber || fallbackCurrent || 1);
		const safeChapterNumber = Math.max(1, Math.min(chapters.length, requested));
		const chapterIndex = safeChapterNumber - 1;
		const chapter = chapters[chapterIndex] || chapters[0];
		const body = document.getElementById('libraryBody');

		updateBookCurrentChapter(bookId, safeChapterNumber);

		body.innerHTML = `
			<div class="reader-shell">
				<div class="reader-top">
					<button type="button" class="ghost-btn" onclick="openLibraryDetail('${book.id}')"><i class="fa-solid fa-arrow-left"></i> Cerrar</button>
					<div class="reader-title">
						<div style="font-size:1.1rem;">
						${escapeLibraryHtml(book.title)}
							<span class="muted">Cap. ${safeChapterNumber}: ${escapeLibraryHtml(chapter.title || `Capítulo ${safeChapterNumber}`)}</span>
						</div>
					</div>
					<div style="display:flex; gap:8px; justify-content:flex-end;">
						${libraryIsAdmin()
							? `<button type="button" class="chapter-edit-btn" onclick="openChapterInEditor('${book.id}', '${chapter.id}')"><i class="fa-solid fa-pen"></i> Editar capítulo</button>`
							: ''}
						<button type="button" class="primary-btn" style="background:#b7986a;" onclick="toggleReaderCaps()"><i class="fa-solid fa-list"></i> Caps</button>
					</div>
				</div>

				<div class="reader-layout">
					<div class="reader-main">
						<div class="reader-body">
							<h2 style="font-size:2rem; font-weight:800; margin:0;">Capítulo ${safeChapterNumber}: ${escapeLibraryHtml(chapter.title || `Capítulo ${safeChapterNumber}`)}</h2>
							<div class="reader-content">${chapter.content || '<span class="muted">Este capítulo no tiene contenido aún.</span>'}</div>
						</div>
					</div>

					<div id="libraryReaderCaps" class="reader-caps">
						<div class="reader-caps-title">Capítulos (${chapters.length})</div>
						${chapters.map((item, index) => `
							<button type="button" class="reader-cap-btn ${index + 1 === safeChapterNumber ? 'active' : ''}" onclick="openLibraryReader('${book.id}', ${index + 1})">
								Cap. ${index + 1}: ${escapeLibraryHtml(item.title || `Capítulo ${index + 1}`)}
							</button>
						`).join('')}
					</div>
				</div>

				<div class="reader-bottom">
					<div>
						<button type="button" class="reader-nav-btn" ${safeChapterNumber <= 1 ? 'disabled' : ''} onclick="openLibraryReader('${book.id}', ${safeChapterNumber - 1})"><i class="fa-solid fa-chevron-left"></i> Anterior</button>
					</div>
					<div style="font-size:1.8rem; font-weight:800; text-align:center;">${safeChapterNumber} / ${chapters.length}</div>
					<div style="text-align:right;">
						<button type="button" class="reader-nav-btn" ${safeChapterNumber >= chapters.length ? 'disabled' : ''} onclick="openLibraryReader('${book.id}', ${safeChapterNumber + 1})">Siguiente <i class="fa-solid fa-chevron-right"></i></button>
					</div>
				</div>
			</div>
		`;
	}

	function startReading(bookId) {
		const books = getLibraryBooks();
		const book = books.find(item => item.id === bookId);
		if (!book) return;

		const chapters = getReadableChapters(book);
		if (chapters.length === 0) {
			alert('Este libro no tiene capítulos para leer aún.');
			return;
		}

		const startChapter = Number(book.currentChapter || 0) > 0
			? Number(book.currentChapter)
			: 1;

		openLibraryReader(bookId, startChapter);
	}

	function triggerLibraryFileInput() {
		document.getElementById('libraryCoverInput')?.click();
	}

	function setLibraryCoverPreview(url) {
		const zone = document.getElementById('libraryCoverZone');
		const img = document.getElementById('libraryCoverPreview');
		if (!zone || !img) return;

		if (!url) {
			img.removeAttribute('src');
			zone.classList.remove('has-preview');
			return;
		}

		img.src = url;
		zone.classList.add('has-preview');
	}

	function resetLibraryForm() {
		document.getElementById('libraryTitleInput').value = '';
		document.getElementById('libraryAuthorInput').value = '';
		document.getElementById('librarySynopsisInput').value = '';
		document.getElementById('libraryStatusInput').value = 'En emisión';
		document.getElementById('libraryCoverInput').value = '';
		setLibraryCoverPreview('');
		editingLibraryBookId = null;
	}

	function openLibraryCreateModal() {
		resetLibraryForm();
		document.getElementById('libraryFormTitle').textContent = 'Crear nuevo libro';
		document.getElementById('libraryCreateActions').style.display = 'grid';
		document.getElementById('libraryEditActions').style.display = 'none';
		document.getElementById('libraryFormModal').classList.add('active');
	}

	function openLibraryEditModal(bookId) {
		const books = getLibraryBooks();
		const book = books.find(item => item.id === bookId);
		if (!book) return;

		editingLibraryBookId = bookId;
		document.getElementById('libraryTitleInput').value = book.title || '';
		document.getElementById('libraryAuthorInput').value = book.author || '';
		document.getElementById('librarySynopsisInput').value = book.synopsis || '';
		document.getElementById('libraryStatusInput').value = book.status || 'En emisión';
		document.getElementById('libraryCoverInput').value = '';
		setLibraryCoverPreview(book.cover || '');

		document.getElementById('libraryFormTitle').textContent = 'Editar libro';
		document.getElementById('libraryCreateActions').style.display = 'none';
		document.getElementById('libraryEditActions').style.display = 'grid';
		document.getElementById('libraryFormModal').classList.add('active');
	}

	function closeLibraryForm() {
		document.getElementById('libraryFormModal').classList.remove('active');
	}

	function fileToLibraryDataURL(file) {
		return new Promise((resolve, reject) => {
			const reader = new FileReader();
			reader.onload = () => resolve(reader.result);
			reader.onerror = reject;
			reader.readAsDataURL(file);
		});
	}

	async function saveLibraryBook() {
		const title = document.getElementById('libraryTitleInput').value.trim();
		const author = document.getElementById('libraryAuthorInput').value.trim();
		const synopsis = document.getElementById('librarySynopsisInput').value.trim();
		const status = document.getElementById('libraryStatusInput').value;
		const coverFile = document.getElementById('libraryCoverInput').files[0];

		if (!title || !author) {
			alert('Título y autor son obligatorios.');
			return;
		}

		const books = getLibraryBooks();
		let cover = '';

		if (editingLibraryBookId) {
			const index = books.findIndex(item => item.id === editingLibraryBookId);
			if (index === -1) return;
			const totalChapters = Math.max(1, Number(books[index].totalChapters || 1));

			cover = books[index].cover || '';
			if (coverFile) cover = await fileToLibraryDataURL(coverFile);

			books[index] = {
				...books[index],
				title,
				author,
				synopsis,
				status,
				totalChapters,
				currentChapter: Math.min(Number(books[index].currentChapter || 0), totalChapters),
				cover,
			};

			setLibraryBooks(books);
			closeLibraryForm();
			openLibraryDetail(books[index].id);
			return;
		}

		if (coverFile) {
			cover = await fileToLibraryDataURL(coverFile);
		} else {
			cover = 'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=600&q=80';
		}

		books.push({
			id: `book-${Date.now()}`,
			title,
			author,
			synopsis,
			status,
			totalChapters: 1,
			currentChapter: 0,
			cover,
			chapters: [],
		});

		setLibraryBooks(books);
		closeLibraryForm();
		renderLibraryHome();
	}

	function confirmDeleteLibraryBook(bookId) {
		if (!confirm('¿Eliminar este libro?')) return;
		const books = getLibraryBooks().filter(item => item.id !== bookId);
		setLibraryBooks(books);
		renderLibraryHome();
	}

	function deleteLibraryBook() {
		if (!editingLibraryBookId) return;
		if (!confirm('¿Eliminar este libro?')) return;

		const books = getLibraryBooks().filter(item => item.id !== editingLibraryBookId);
		setLibraryBooks(books);
		closeLibraryForm();
		renderLibraryHome();
	}

	function openLibraryFloating() {
		const safeWidth = Math.max(LIBRARY_MIN_WIDTH, Math.floor(window.innerWidth * 0.9));
		const safeHeight = Math.max(LIBRARY_MIN_HEIGHT, Math.floor((window.innerHeight - 72) * 0.84));

		isLibraryMaximized = false;
		libraryWindow.classList.remove('maximized');
		libraryWindow.style.display = 'flex';
		libraryWindow.style.position = 'fixed';
		libraryWindow.style.width = safeWidth + 'px';
		libraryWindow.style.height = safeHeight + 'px';
		libraryWindow.style.top = Math.max(0, Math.floor((window.innerHeight - 72 - safeHeight) / 2)) + 'px';
		libraryWindow.style.left = '50%';
		libraryWindow.style.right = 'auto';
		libraryWindow.style.bottom = 'auto';
		libraryWindow.style.transform = 'translateX(-50%)';
		libraryWindow.style.borderRadius = '1rem';
		libraryWindow.style.resize = 'both';

		const btn = document.getElementById('libraryMaxBtn');
		if (btn) btn.innerHTML = '<i class="fa-regular fa-square"></i>';
	}

	function openLibraryMaximized() {
		isLibraryMaximized = true;
		libraryWindow.classList.add('maximized');
		libraryWindow.style.display = 'flex';
		libraryWindow.style.position = 'fixed';
		libraryWindow.style.width = '100%';
		libraryWindow.style.height = 'calc(100vh - 72px)';
		libraryWindow.style.top = '0';
		libraryWindow.style.left = '0';
		libraryWindow.style.transform = 'none';
		libraryWindow.style.borderRadius = '0';
		libraryWindow.style.resize = 'none';

		const btn = document.getElementById('libraryMaxBtn');
		if (btn) btn.innerHTML = '<i class="fa-regular fa-window-restore"></i>';
	}

	function clampLibraryIntoViewport() {
		if (isLibraryMaximized) return;

		const rect = libraryWindow.getBoundingClientRect();
		let left = rect.left;
		let top = rect.top;
		const maxLeft = Math.max(0, window.innerWidth - rect.width);
		const maxTop = Math.max(0, (window.innerHeight - 72) - rect.height);

		left = Math.max(0, Math.min(left, maxLeft));
		top = Math.max(0, Math.min(top, maxTop));

		libraryWindow.style.left = left + 'px';
		libraryWindow.style.top = top + 'px';
		libraryWindow.style.transform = 'none';
	}

	function minimizeLibrary() {
		sendLibraryMessage('focus');
		sendLibraryMessage('minimize', { mode: isLibraryMaximized ? 'maximized' : 'floating' });
	}

	function toggleMaximizeLibrary() {
		sendLibraryMessage('focus');
		isLibraryMaximized = !isLibraryMaximized;
		if (isLibraryMaximized) {
			openLibraryMaximized();
			sendLibraryMessage('maximize');
		} else {
			openLibraryFloating();
			sendLibraryMessage('restore');
		}
	}

	function closeLibrary() {
		sendLibraryMessage('focus');
		sendLibraryMessage('close');
	}

	window.addEventListener('message', (event) => {
		if (!event.data || !event.data.type) return;
		if (event.data.app && event.data.app !== 'library') return;

		if (event.data.type === 'openFloating') {
			openLibraryFloating();
		} else if (event.data.type === 'openMaximized') {
			openLibraryMaximized();
		}
	});

	libraryHeader.addEventListener('mousedown', (event) => {
		if (event.target.closest('.window-controls') || isLibraryMaximized) return;
		isLibraryDragging = true;
		sendLibraryMessage('focus');
		const rect = libraryWindow.getBoundingClientRect();
		libraryDragOffsetX = event.clientX - rect.left;
		libraryDragOffsetY = event.clientY - rect.top;
	});

	libraryResizeHandle.addEventListener('mousedown', (event) => {
		event.stopPropagation();
		if (isLibraryMaximized) return;
		isLibraryResizing = true;
		sendLibraryMessage('focus');
		const rect = libraryWindow.getBoundingClientRect();
		libraryStartX = event.clientX;
		libraryStartY = event.clientY;
		libraryStartW = rect.width;
		libraryStartH = rect.height;
	});

	document.addEventListener('mousemove', (event) => {
		if (isLibraryDragging && !isLibraryMaximized) {
			const rect = libraryWindow.getBoundingClientRect();
			const maxLeft = Math.max(0, window.innerWidth - rect.width);
			const maxTop = Math.max(0, (window.innerHeight - 72) - rect.height);
			const left = Math.max(0, Math.min(event.clientX - libraryDragOffsetX, maxLeft));
			const top = Math.max(0, Math.min(event.clientY - libraryDragOffsetY, maxTop));
			libraryWindow.style.left = left + 'px';
			libraryWindow.style.top = top + 'px';
			libraryWindow.style.transform = 'none';
		}

		if (isLibraryResizing && !isLibraryMaximized) {
			const rect = libraryWindow.getBoundingClientRect();
			const maxWidth = Math.max(LIBRARY_MIN_WIDTH, window.innerWidth - rect.left);
			const maxHeight = Math.max(LIBRARY_MIN_HEIGHT, (window.innerHeight - 72) - rect.top);
			const width = Math.min(maxWidth, Math.max(LIBRARY_MIN_WIDTH, libraryStartW + (event.clientX - libraryStartX)));
			const height = Math.min(maxHeight, Math.max(LIBRARY_MIN_HEIGHT, libraryStartH + (event.clientY - libraryStartY)));
			libraryWindow.style.width = width + 'px';
			libraryWindow.style.height = height + 'px';
		}
	});

	document.addEventListener('mouseup', () => {
		isLibraryDragging = false;
		isLibraryResizing = false;
	});

	libraryWindow.addEventListener('mousedown', () => sendLibraryMessage('focus'));

	window.addEventListener('resize', clampLibraryIntoViewport);

	function bootstrapLibrary() {
		renderLibraryHome();
		openLibraryFloating();

		document.getElementById('libraryCoverInput')?.addEventListener('change', async () => {
			const input = document.getElementById('libraryCoverInput');
			const file = input?.files?.[0];
			if (!file) {
				setLibraryCoverPreview('');
				return;
			}
			const dataUrl = await fileToLibraryDataURL(file);
			setLibraryCoverPreview(dataUrl);
		});
	}

	bootstrapLibrary();

	window.LibraryApp = {
		openFloating: openLibraryFloating,
		openMaximized: openLibraryMaximized,
	};
</script>
