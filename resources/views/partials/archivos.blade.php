<style>
	#filesModal .files-window {
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

	#filesModal .files-window.maximized {
		top: 0;
		left: 0;
		width: 100%;
		height: calc(100vh - 72px);
		transform: none;
		border-radius: 0;
		resize: none;
	}

	#filesModal .window-header {
		height: 52px;
		background: #443C3D;
		color: #E2D8CC;
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 0 16px;
		cursor: move;
		flex-shrink: 0;
	}

	#filesModal .window-title {
		display: flex;
		align-items: center;
		gap: 10px;
		font-weight: 700;
	}

	#filesModal .window-controls {
		display: flex;
		gap: 10px;
	}

	#filesModal .window-btn {
		width: 28px;
		height: 28px;
		border: none;
		border-radius: 6px;
		background: rgba(255, 255, 255, 0.2);
		color: #E2D8CC;
		cursor: pointer;
	}

	#filesModal .window-btn:hover { background: rgba(255, 255, 255, 0.35); }
	#filesModal .window-btn.close:hover { background: #9b2f2f; }

	#filesModal .resize-handle {
		position: absolute;
		bottom: 0;
		right: 0;
		width: 20px;
		height: 20px;
		cursor: se-resize;
		background: linear-gradient(135deg, transparent 50%, #443C3D 50%);
		opacity: 0.35;
	}

	#filesModal .files-window.maximized .resize-handle { display: none; }

	#filesModal .files-body { flex: 1; overflow: auto; }

	#filesModal .top-bar {
		padding: 14px 16px;
		border-bottom: 2px solid #5a5250;
		display: grid;
		grid-template-columns: 1fr auto auto auto;
		gap: 10px;
		align-items: center;
	}

	#filesModal .search-wrap { position: relative; }

	#filesModal .search-input,
	#filesModal .input,
	#filesModal .select {
		width: 100%;
		border: 2px solid #5a5250;
		border-radius: 14px;
		background: #f2f2f2;
		color: #443C3D;
		padding: 10px 12px;
		outline: none;
		font-size: 1rem;
	}

	#filesModal .search-input { padding-left: 36px; }

	#filesModal .search-icon {
		position: absolute;
		left: 12px;
		top: 50%;
		transform: translateY(-50%);
		color: #8f8586;
	}

	#filesModal .icon-btn {
		border: 2px solid #5a5250;
		border-radius: 12px;
		background: #f2f2f2;
		color: #443C3D;
		width: 48px;
		height: 48px;
		cursor: pointer;
		font-size: 1.2rem;
	}

	#filesModal .primary-btn {
		border: none;
		border-radius: 14px;
		background: #443C3D;
		color: #E2D8CC;
		padding: 11px 16px;
		font-weight: 700;
		cursor: pointer;
		font-size: 1rem;
		white-space: nowrap;
	}

	#filesModal .ghost-btn {
		border: 2px solid #5a5250;
		border-radius: 14px;
		background: #fff;
		color: #443C3D;
		padding: 10px 16px;
		font-weight: 700;
		cursor: pointer;
	}

	#filesModal .toolbar-title {
		font-size: 2rem;
		font-weight: 800;
		margin: 18px 18px 10px;
	}

	#filesModal .folders-grid {
		padding: 0 16px 16px;
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
		gap: 14px;
	}

	#filesModal .folder-card {
		border: 2px solid #5a5250;
		border-radius: 16px;
		background: #f2f2f2;
		min-height: 180px;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		cursor: pointer;
		transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease, background-color 0.18s ease;
	}

	#filesModal .folder-card:hover {
		transform: translateY(-4px);
		box-shadow: 0 12px 24px rgba(0, 0, 0, 0.18);
		border-color: #443C3D;
		background: #e8ddd0;
	}

	#filesModal .folder-icon {
		width: 82px;
		height: 82px;
		border-radius: 18px;
		border: 2px solid #5a5250;
		background: #b5a89b;
		display: grid;
		place-items: center;
		font-size: 2rem;
		margin-bottom: 10px;
	}

	#filesModal .folder-name {
		font-size: 1.85rem;
		font-weight: 800;
		line-height: 1;
	}

	#filesModal .muted {
		color: #7a7172;
		font-size: 0.92rem;
	}

	#filesModal .folder-files-list {
		padding: 16px;
		display: flex;
		flex-direction: column;
		gap: 12px;
	}

	#filesModal .folder-tools-grid {
		display: grid;
		grid-template-columns: 1fr auto;
		gap: 10px;
	}

	#filesModal .remove-file-list {
		display: flex;
		flex-direction: column;
		gap: 8px;
	}

	#filesModal .remove-file-item {
		display: grid;
		grid-template-columns: 1fr auto;
		align-items: center;
		gap: 10px;
		padding: 8px 10px;
		border: 2px solid #5a5250;
		border-radius: 10px;
		background: #fff;
	}

	#filesModal .danger-btn {
		border: none;
		border-radius: 12px;
		background: #9b2f2f;
		color: #fff;
		padding: 10px 14px;
		font-weight: 700;
		cursor: pointer;
	}

	#filesModal .danger-soft-btn {
		border: 2px solid #9b2f2f;
		border-radius: 10px;
		background: #fff;
		color: #9b2f2f;
		padding: 7px 10px;
		font-weight: 700;
		cursor: pointer;
	}

	#filesModal .file-row {
		border: 2px solid #5a5250;
		border-radius: 14px;
		background: #f2f2f2;
		padding: 14px;
		display: flex;
		justify-content: space-between;
		align-items: center;
		cursor: pointer;
	}

	#filesModal .badge {
		border-radius: 999px;
		background: #f9dada;
		color: #b82f2f;
		font-size: 0.78rem;
		padding: 4px 10px;
		font-weight: 700;
	}

	#filesModal .viewer-wrap { padding: 14px; }

	#filesModal .viewer-img {
		width: 100%;
		max-height: calc(100vh - 260px);
		object-fit: contain;
		border: 2px solid #5a5250;
		border-radius: 14px;
		background: #f2f2f2;
	}

	#filesModal .modal-backdrop {
		position: fixed;
		inset: 0;
		background: rgba(0,0,0,0.45);
		display: none;
		align-items: center;
		justify-content: center;
		z-index: 2400;
		pointer-events: auto;
	}

	#filesModal .modal-backdrop.active { display: flex; }

	#filesModal .modal-box {
		width: min(700px, calc(100% - 24px));
		max-height: calc(100% - 24px);
		overflow: auto;
		background: #E2D8CC;
		border: 2px solid #5a5250;
		border-radius: 16px;
		padding: 18px;
	}

	#filesModal .modal-head {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 12px;
	}

	#filesModal .upload-zone {
		margin-top: 8px;
		border: 2px dashed #5a5250;
		border-radius: 14px;
		background: #D0C4B4;
		min-height: 160px;
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
		overflow: hidden;
		text-align: center;
		color: #7a7172;
	}

	#filesModal .upload-preview {
		display: none;
		width: 100%;
		height: 220px;
		object-fit: cover;
	}

	#filesModal .upload-zone.has-preview .upload-preview { display: block; }
	#filesModal .upload-zone.has-preview .upload-zone-content { display: none; }

	#filesModal .modal-actions {
		display: grid;
		grid-template-columns: 1fr 1fr;
		gap: 10px;
		margin-top: 14px;
	}

	#filesModal .hidden-file-input { display: none; }

	@media (max-width: 900px) {
		#filesModal .top-bar {
			grid-template-columns: 1fr auto auto;
		}

		#filesModal .folders-grid {
			grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
		}

		#filesModal .folder-name {
			font-size: 1.4rem;
		}
	}

	@media (max-width: 768px) {
		#filesModal .files-window {
			top: 0;
			left: 0;
			width: 100%;
			height: calc(100vh - 72px);
			transform: none;
			border-radius: 0;
			resize: none;
		}

		#filesModal .resize-handle {
			display: none;
		}

		#filesModal .top-bar {
			grid-template-columns: 1fr;
		}

		#filesModal .top-bar .ghost-btn,
		#filesModal .top-bar .primary-btn,
		#filesModal .top-bar .icon-btn {
			width: 100%;
			height: 44px;
		}

		#filesModal .toolbar-title {
			font-size: 1.5rem;
			margin: 14px 14px 8px;
		}

		#filesModal .folders-grid,
		#filesModal .folder-files-list,
		#filesModal .viewer-wrap {
			padding: 12px;
		}

		#filesModal .file-row {
			flex-direction: column;
			align-items: flex-start;
			gap: 8px;
		}

		#filesModal .folder-tools-grid,
		#filesModal .modal-actions,
		#filesModal .remove-file-item {
			grid-template-columns: 1fr;
		}

		#filesModal .modal-box {
			padding: 12px;
			width: calc(100% - 12px);
			max-height: calc(100% - 12px);
		}
	}

	@media (max-width: 420px) {
		#filesModal .top-bar .ghost-btn,
		#filesModal .top-bar .primary-btn {
			font-size: 0;
			padding: 0;
		}

		#filesModal .top-bar .ghost-btn i,
		#filesModal .top-bar .primary-btn i {
			font-size: 1rem;
			margin: 0;
		}

		#filesModal .folder-card {
			min-height: 150px;
		}

		#filesModal .folder-icon {
			width: 68px;
			height: 68px;
			font-size: 1.6rem;
		}
	}
</style>

<div class="files-window" id="filesWindow">
	<div class="window-header">
		<div class="window-title">
			<i class="fa-regular fa-folder"></i>
			<span>Archivos</span>
		</div>
		<div class="window-controls">
			<button class="window-btn" type="button" onclick="minimizeFilesWindow()"><i class="fa-solid fa-minus"></i></button>
			<button class="window-btn" type="button" onclick="toggleMaximizeFilesWindow()" id="filesMaxBtn"><i class="fa-regular fa-square"></i></button>
			<button class="window-btn close" type="button" onclick="closeFilesWindow()"><i class="fa-solid fa-xmark"></i></button>
		</div>
	</div>
	<div class="files-body" id="filesBody"></div>
	<div class="resize-handle" id="filesResizeHandle"></div>
</div>

<div class="modal-backdrop" id="createFolderModal">
	<div class="modal-box">
		<div class="modal-head">
			<h3 style="font-size:1.4rem; font-weight:800;">Crear carpeta</h3>
			<button type="button" class="window-btn close" onclick="closeCreateFolderModal()"><i class="fa-solid fa-xmark"></i></button>
		</div>
		<label style="font-weight:700;">Nombre de carpeta</label>
		<input class="input" id="folderNameInput" placeholder="Ej: Dribbble" />
		<div class="modal-actions">
			<button type="button" class="ghost-btn" onclick="closeCreateFolderModal()">Cancelar</button>
			<button type="button" class="primary-btn" onclick="saveFolder()">Crear</button>
		</div>
	</div>
</div>

<div class="modal-backdrop" id="uploadImageModal">
	<div class="modal-box">
		<div class="modal-head">
			<h3 style="font-size:1.4rem; font-weight:800;">Subir Imagen</h3>
			<button type="button" class="window-btn close" onclick="closeUploadImageModal()"><i class="fa-solid fa-xmark"></i></button>
		</div>

		<label style="font-weight:700;">Imagen</label>
		<input class="hidden-file-input" type="file" id="uploadImageInput" accept="image/*" />
		<div class="upload-zone" id="uploadImageZone" onclick="triggerUploadImageInput()">
			<img id="uploadImagePreview" class="upload-preview" alt="preview">
			<div class="upload-zone-content">
				<i class="fa-solid fa-upload" style="font-size:2rem;"></i>
				<div style="font-weight:700; margin-top:6px;">Haz clic o arrastra una imagen aquí</div>
				<div style="font-size:0.85rem; margin-top:4px;">PNG, JPG, GIF, WEBP</div>
			</div>
		</div>

		<div style="margin-top:12px;">
			<label style="font-weight:700;">Nombre</label>
			<input class="input" id="uploadNameInput" placeholder="nombre-de-imagen" />
		</div>

		<div style="margin-top:12px;">
			<label style="font-weight:700;">Carpeta destino</label>
			<select class="select" id="uploadFolderSelect"></select>
		</div>

		<div style="margin-top:14px; border-top:2px solid #5a5250; padding-top:14px;">
			<label style="display:flex; align-items:center; gap:8px; font-weight:700;">
				<input type="checkbox" id="uploadProtectCheck" onchange="toggleUploadPassword()" />
				<span>Proteger imagen con contraseña</span>
			</label>
			<input class="input" id="uploadPasswordInput" type="password" placeholder="Contraseña" style="margin-top:8px; display:none;" />
		</div>

		<div class="modal-actions">
			<button type="button" class="ghost-btn" onclick="closeUploadImageModal()">Cancelar</button>
			<button type="button" class="primary-btn" onclick="saveUploadedImage()">Subir</button>
		</div>
	</div>
</div>

<div class="modal-backdrop" id="unlockFileModal">
	<div class="modal-box" style="width:min(520px, calc(100% - 24px));">
		<div class="modal-head">
			<h3 style="font-size:1.6rem; font-weight:800;">Archivo Protegido</h3>
			<button type="button" class="window-btn close" onclick="closeUnlockFileModal()"><i class="fa-solid fa-xmark"></i></button>
		</div>
		<div style="margin-bottom:10px; color:#5b626f;">Ingresa la contraseña para desbloquear este archivo.</div>
		<input class="input" id="unlockPasswordInput" type="password" placeholder="Contraseña" />
		<div id="unlockHint" class="muted" style="margin-top:8px; display:none; color:#b82f2f;">Contraseña incorrecta.</div>
		<div class="modal-actions">
			<button type="button" class="ghost-btn" onclick="closeUnlockFileModal()">Cancelar</button>
			<button type="button" class="primary-btn" onclick="submitUnlockFile()">Desbloquear</button>
		</div>
	</div>
</div>

<div class="modal-backdrop" id="editFolderModal">
	<div class="modal-box">
		<div class="modal-head">
			<h3 style="font-size:1.4rem; font-weight:800;">Editar carpeta</h3>
			<button type="button" class="window-btn close" onclick="closeEditFolderModal()"><i class="fa-solid fa-xmark"></i></button>
		</div>

		<label style="font-weight:700;">Nombre de carpeta</label>
		<div class="folder-tools-grid" style="margin-top:8px;">
			<input id="editFolderNameInput" class="input" placeholder="Nuevo nombre" />
			<button class="ghost-btn" type="button" onclick="saveEditFolderName()">Guardar nombre</button>
		</div>

		<div style="margin-top:14px; border-top:2px solid #5a5250; padding-top:12px;">
			<div style="font-weight:700; margin-bottom:8px;">Quitar archivos</div>
			<div id="editFolderFilesList" class="remove-file-list"></div>
		</div>

		<div class="modal-actions">
			<button type="button" class="ghost-btn" onclick="closeEditFolderModal()">Cerrar</button>
			<button type="button" class="danger-btn" onclick="deleteFolderFromEditModal()"><i class="fa-solid fa-trash"></i> Eliminar carpeta</button>
		</div>
	</div>
</div>

<script>
	const FILES_MIN_WIDTH = 320;
	const FILES_MIN_HEIGHT = 240;
	const FILES_USER_ROLE = @json($userType ?? 'guest');
	const FILES_CSRF = @json(csrf_token());

	let isFilesMaximized = false;
	let isFilesDragging = false;
	let isFilesResizing = false;
	let filesDragOffsetX = 0;
	let filesDragOffsetY = 0;
	let filesStartX = 0;
	let filesStartY = 0;
	let filesStartW = 0;
	let filesStartH = 0;

	let currentFolderId = null;
	let currentSearch = '';
	let currentViewingFileId = null;
	let pendingUnlockFileId = null;
	let editingFolderId = null;
	let filesDataCache = { folders: [], files: [] };
	const unlockedFiles = new Set();

	const filesWindow = document.getElementById('filesWindow');
	const filesResizeHandle = document.getElementById('filesResizeHandle');
	const filesHeader = filesWindow.querySelector('.window-header');

	function sendFilesMessage(type, extra = {}) {
		const payload = { app: 'files', type, ...extra };
		if (window.parent && window.parent !== window) {
			window.parent.postMessage(payload, '*');
		} else {
			window.postMessage(payload, '*');
		}
	}

	async function filesApi(url, options = {}) {
		const headers = {
			'Accept': 'application/json',
			'X-Requested-With': 'XMLHttpRequest',
			...options.headers,
		};

		if (options.body && !(options.body instanceof FormData)) {
			headers['Content-Type'] = 'application/json';
			headers['X-CSRF-TOKEN'] = FILES_CSRF;
		}

		if ((options.method || 'GET').toUpperCase() !== 'GET' && !headers['X-CSRF-TOKEN']) {
			headers['X-CSRF-TOKEN'] = FILES_CSRF;
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

	async function loadFilesDataFromApi() {
		const [foldersRes, writingsRes] = await Promise.all([
			filesApi('/archivos/carpetas'),
			filesApi('/archivos/escritos'),
		]);

		const folders = Array.isArray(foldersRes?.folders)
			? foldersRes.folders.map(folder => ({
				id: String(folder.id),
				name: folder.name || 'Sin nombre',
			}))
			: [];

		const files = Array.isArray(writingsRes?.writings)
			? writingsRes.writings.map(writing => ({
				id: String(writing.id),
				folderId: writing.folder_id ? String(writing.folder_id) : null,
				name: writing.title || 'Sin título',
				image: writing.image_path || '',
				password: writing.password || null,
				textContent: writing.text_content || '',
				htmlContent: writing.html_content || '',
			}))
			: [];

		filesDataCache = { folders, files };
	}

	function getFilesData() {
		return filesDataCache;
	}

	function setFilesData(data) {
		filesDataCache = data;
	}

	function filesIsAdmin() {
		return FILES_USER_ROLE === 'admin';
	}

	function escapeFilesHtml(text) {
		return (text || '')
			.replaceAll('&', '&amp;')
			.replaceAll('<', '&lt;')
			.replaceAll('>', '&gt;')
			.replaceAll('"', '&quot;')
			.replaceAll("'", '&#39;');
	}

	function folderFileCount(folderId, data) {
		return data.files.filter(file => file.folderId === folderId).length;
	}

	function renderFolderGrid() {
		currentFolderId = null;
		currentViewingFileId = null;
		const data = getFilesData();
		const folders = data.folders.filter(folder => folder.name.toLowerCase().includes(currentSearch.toLowerCase()));

		document.getElementById('filesBody').innerHTML = `
			<div class="top-bar">
				<div class="search-wrap">
					<i class="fa-solid fa-magnifying-glass search-icon"></i>
					<input class="search-input" placeholder="Buscar carpetas y archivos..." value="${escapeFilesHtml(currentSearch)}" oninput="setFilesSearch(this.value)" />
				</div>
				<button class="icon-btn" type="button" onclick="refreshFilesView()"><i class="fa-solid fa-rotate-right"></i></button>
				${filesIsAdmin() ? '<button class="ghost-btn" type="button" onclick="openCreateFolderModal()"><i class="fa-solid fa-folder-plus"></i> Nueva carpeta</button>' : ''}
				${filesIsAdmin() ? '<button class="primary-btn" type="button" onclick="openUploadImageModal()"><i class="fa-solid fa-plus"></i> Subir Imagen</button>' : ''}
			</div>
			<div class="toolbar-title">Mis Carpetas</div>
			<div class="folders-grid">
				${folders.map(folder => `
					<div class="folder-card" onclick="openFolder('${folder.id}')">
						<div class="folder-icon"><i class="fa-regular fa-folder"></i></div>
						<div class="folder-name">${escapeFilesHtml(folder.name)}</div>
						<div class="muted">${folderFileCount(folder.id, data)} archivo${folderFileCount(folder.id, data) === 1 ? '' : 's'}</div>
					</div>
				`).join('')}
			</div>
		`;
	}

	function setFilesSearch(value) {
		currentSearch = value;
		renderFolderGrid();
	}

	async function refreshFilesView() {
		await loadFilesDataFromApi();
		if (currentViewingFileId) {
			openFileViewer(currentViewingFileId);
			return;
		}
		if (currentFolderId) {
			openFolder(currentFolderId);
			return;
		}
		renderFolderGrid();
	}

	function openFolder(folderId) {
		currentFolderId = folderId;
		currentViewingFileId = null;
		const data = getFilesData();
		const folder = data.folders.find(item => item.id === folderId);
		if (!folder) return;
		const files = data.files.filter(file => file.folderId === folderId);

		document.getElementById('filesBody').innerHTML = `
			<div class="top-bar" style="grid-template-columns: 1fr auto auto;">
				<button class="ghost-btn" type="button" onclick="renderFolderGrid()"><i class="fa-solid fa-arrow-left"></i> Volver a Carpetas</button>
				${filesIsAdmin() ? `<button class="ghost-btn" type="button" onclick="openEditFolderModal('${folder.id}')"><i class="fa-solid fa-pen-to-square"></i> Editar carpeta</button>` : ''}
				${filesIsAdmin() ? `<button class="primary-btn" type="button" onclick="openUploadImageModal('${folder.id}')"><i class="fa-solid fa-plus"></i> Subir Imagen</button>` : ''}
			</div>
			<div class="toolbar-title" style="margin-top:10px;">${escapeFilesHtml(folder.name)}</div>
			<div class="folder-files-list">
				${files.map(file => {
					const locked = !!file.password && !unlockedFiles.has(file.id);
					return `
						<div class="file-row" onclick="openFileById('${file.id}')">
							<div style="display:flex; gap:10px; align-items:center;">
								<i class="fa-regular ${locked ? 'fa-file' : 'fa-image'}" style="font-size:1.5rem; color:${locked ? '#d32f2f' : '#10a64a'}"></i>
								<div style="font-weight:700; font-size:1.05rem;">${escapeFilesHtml(file.name)}</div>
							</div>
							${locked ? '<span class="badge">Bloqueado</span>' : ''}
						</div>
					`;
				}).join('')}
				${files.length === 0 ? '<div class="muted" style="padding:8px 4px;">No hay imágenes en esta carpeta.</div>' : ''}
			</div>
		`;
	}

	function openEditFolderModal(folderId) {
		if (!filesIsAdmin()) return;
		const data = getFilesData();
		const folder = data.folders.find(item => item.id === folderId);
		if (!folder) return;

		editingFolderId = folderId;
		document.getElementById('editFolderNameInput').value = folder.name;
		renderEditFolderFilesList();
		document.getElementById('editFolderModal').classList.add('active');
	}

	function closeEditFolderModal() {
		editingFolderId = null;
		document.getElementById('editFolderModal').classList.remove('active');
	}

	function renderEditFolderFilesList() {
		const wrap = document.getElementById('editFolderFilesList');
		if (!wrap || !editingFolderId) return;

		const data = getFilesData();
		const files = data.files.filter(item => item.folderId === editingFolderId);
		wrap.innerHTML = files.length > 0
			? files.map(file => `
				<div class="remove-file-item">
					<div style="font-weight:600; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">${escapeFilesHtml(file.name)}</div>
					<button class="danger-soft-btn" type="button" onclick="removeFileFromEditModal('${file.id}')">Quitar</button>
				</div>
			`).join('')
			: '<div class="muted">No hay archivos para quitar.</div>';
	}

	async function saveEditFolderName() {
		if (!filesIsAdmin()) return;
		if (!editingFolderId) return;
		const input = document.getElementById('editFolderNameInput');
		if (!input) return;
		const newName = input.value.trim();

		if (!newName) {
			alert('Ingresa un nombre para la carpeta.');
			return;
		}

		const data = getFilesData();
		const exists = data.folders.some(item => item.id !== editingFolderId && item.name.toLowerCase() === newName.toLowerCase());
		if (exists) {
			alert('Ya existe una carpeta con ese nombre.');
			return;
		}

		try {
			await filesApi(`/archivos/carpetas/${editingFolderId}`, {
				method: 'PUT',
				body: JSON.stringify({ name: newName }),
			});
			await loadFilesDataFromApi();
			openFolder(editingFolderId);
			document.getElementById('editFolderNameInput').value = newName;
		} catch (error) {
			alert(error.message || 'No se pudo actualizar la carpeta.');
		}
	}

	async function removeFileFromEditModal(fileId) {
		if (!filesIsAdmin()) return;
		if (!editingFolderId) return;
		const data = getFilesData();
		const file = data.files.find(item => item.id === fileId && item.folderId === editingFolderId);
		if (!file) return;

		const ok = confirm(`¿Quitar el archivo "${file.name}"?`);
		if (!ok) return;

		try {
			await filesApi(`/archivos/escritos/${fileId}`, { method: 'DELETE' });
			unlockedFiles.delete(fileId);
			if (currentViewingFileId === fileId) {
				currentViewingFileId = null;
			}
			await loadFilesDataFromApi();
			openFolder(editingFolderId);
			renderEditFolderFilesList();
		} catch (error) {
			alert(error.message || 'No se pudo eliminar el archivo.');
		}
	}

	async function deleteFolderFromEditModal() {
		if (!filesIsAdmin()) return;
		if (!editingFolderId) return;
		const data = getFilesData();
		const folder = data.folders.find(item => item.id === editingFolderId);
		if (!folder) return;

		const folderFiles = data.files.filter(item => item.folderId === editingFolderId);
		const ok = confirm(`¿Eliminar la carpeta "${folder.name}" y ${folderFiles.length} archivo(s)?`);
		if (!ok) return;

		try {
			await filesApi(`/archivos/carpetas/${editingFolderId}`, { method: 'DELETE' });
			folderFiles.forEach(file => unlockedFiles.delete(file.id));
			await loadFilesDataFromApi();
			closeEditFolderModal();
			currentFolderId = null;
			currentViewingFileId = null;
			renderFolderGrid();
		} catch (error) {
			alert(error.message || 'No se pudo eliminar la carpeta.');
		}
	}

	function openFileById(fileId) {
		const data = getFilesData();
		const file = data.files.find(item => item.id === fileId);
		if (!file) return;

		if (file.password && !unlockedFiles.has(fileId)) {
			pendingUnlockFileId = fileId;
			document.getElementById('unlockPasswordInput').value = '';
			document.getElementById('unlockHint').style.display = 'none';
			document.getElementById('unlockFileModal').classList.add('active');
			return;
		}

		openFileViewer(fileId);
	}

	function openFileViewer(fileId) {
		const data = getFilesData();
		const file = data.files.find(item => item.id === fileId);
		if (!file) return;

		currentViewingFileId = fileId;
		document.getElementById('filesBody').innerHTML = `
			<div class="top-bar" style="grid-template-columns: 1fr;">
				<div style="display:flex; justify-content:space-between; align-items:center;">
					<button class="ghost-btn" type="button" onclick="openFolder('${file.folderId}')"><i class="fa-solid fa-arrow-left"></i> Volver</button>
					<div style="font-size:1.8rem; font-weight:800;">${escapeFilesHtml(file.name)}</div>
					<div style="width:120px"></div>
				</div>
			</div>
			<div class="viewer-wrap">
				<img class="viewer-img" src="${file.image}" alt="${escapeFilesHtml(file.name)}" />
			</div>
		`;
	}

	function closeUnlockFileModal() {
		pendingUnlockFileId = null;
		document.getElementById('unlockFileModal').classList.remove('active');
	}

	function submitUnlockFile() {
		if (!pendingUnlockFileId) return;
		const data = getFilesData();
		const file = data.files.find(item => item.id === pendingUnlockFileId);
		if (!file) return;

		const pass = document.getElementById('unlockPasswordInput').value;
		if (pass !== file.password) {
			document.getElementById('unlockHint').style.display = 'block';
			return;
		}

		unlockedFiles.add(file.id);
		const unlockedId = pendingUnlockFileId;
		closeUnlockFileModal();
		openFileViewer(unlockedId);
	}

	function openCreateFolderModal() {
		if (!filesIsAdmin()) return;
		document.getElementById('folderNameInput').value = '';
		document.getElementById('createFolderModal').classList.add('active');
	}

	function closeCreateFolderModal() {
		document.getElementById('createFolderModal').classList.remove('active');
	}

	async function saveFolder() {
		if (!filesIsAdmin()) return;
		const name = document.getElementById('folderNameInput').value.trim();
		if (!name) {
			alert('Ingresa un nombre para la carpeta.');
			return;
		}

		const data = getFilesData();
		const exists = data.folders.some(folder => folder.name.toLowerCase() === name.toLowerCase());
		if (exists) {
			alert('Ya existe una carpeta con ese nombre.');
			return;
		}

		try {
			await filesApi('/archivos/carpetas', {
				method: 'POST',
				body: JSON.stringify({ name }),
			});
			await loadFilesDataFromApi();
			closeCreateFolderModal();
			renderFolderGrid();
		} catch (error) {
			alert(error.message || 'No se pudo crear la carpeta.');
		}
	}

	function triggerUploadImageInput() {
		document.getElementById('uploadImageInput')?.click();
	}

	function setUploadPreview(url) {
		const zone = document.getElementById('uploadImageZone');
		const preview = document.getElementById('uploadImagePreview');
		if (!zone || !preview) return;

		if (!url) {
			preview.removeAttribute('src');
			zone.classList.remove('has-preview');
			return;
		}

		preview.src = url;
		zone.classList.add('has-preview');
	}

	function toggleUploadPassword() {
		const checked = document.getElementById('uploadProtectCheck').checked;
		document.getElementById('uploadPasswordInput').style.display = checked ? 'block' : 'none';
	}

	async function openUploadImageModal(preselectedFolderId = null) {
		if (!filesIsAdmin()) return;
		await loadFilesDataFromApi();
		const data = getFilesData();
		const select = document.getElementById('uploadFolderSelect');
		select.innerHTML = data.folders.map(folder => `<option value="${folder.id}">${escapeFilesHtml(folder.name)}</option>`).join('');
		if (!data.folders.length) {
			alert('Primero crea una carpeta en Archivos.');
			return;
		}
		if (preselectedFolderId) select.value = preselectedFolderId;

		document.getElementById('uploadImageInput').value = '';
		document.getElementById('uploadNameInput').value = '';
		document.getElementById('uploadProtectCheck').checked = false;
		document.getElementById('uploadPasswordInput').value = '';
		document.getElementById('uploadPasswordInput').style.display = 'none';
		setUploadPreview('');

		document.getElementById('uploadImageModal').classList.add('active');
	}

	function closeUploadImageModal() {
		document.getElementById('uploadImageModal').classList.remove('active');
	}

	function fileToDataURL(file) {
		return new Promise((resolve, reject) => {
			const reader = new FileReader();
			reader.onload = () => resolve(reader.result);
			reader.onerror = reject;
			reader.readAsDataURL(file);
		});
	}

	async function saveUploadedImage() {
		if (!filesIsAdmin()) return;
		const imageFile = document.getElementById('uploadImageInput').files[0];
		const name = document.getElementById('uploadNameInput').value.trim();
		const folderId = document.getElementById('uploadFolderSelect').value;
		const protectedFile = document.getElementById('uploadProtectCheck').checked;
		const password = document.getElementById('uploadPasswordInput').value;

		if (!imageFile || !name || !folderId) {
			alert('Selecciona imagen, nombre y carpeta destino.');
			return;
		}

		if (protectedFile && !password) {
			alert('Ingresa una contraseña para proteger el archivo.');
			return;
		}

		try {
			const dataUrl = await fileToDataURL(imageFile);
			await filesApi('/archivos/escritos', {
				method: 'POST',
				body: JSON.stringify({
					title: name,
					folder_id: Number(folderId),
					image_path: dataUrl,
					text_content: null,
					html_content: null,
					password: protectedFile ? password : null,
				}),
			});

			await loadFilesDataFromApi();
			closeUploadImageModal();
			if (currentFolderId) {
				openFolder(currentFolderId);
			} else {
				renderFolderGrid();
			}
		} catch (error) {
			alert(error.message || 'No se pudo guardar la imagen.');
		}
	}

	function openFilesFloating() {
		const safeWidth = Math.max(FILES_MIN_WIDTH, Math.floor(window.innerWidth * 0.9));
		const safeHeight = Math.max(FILES_MIN_HEIGHT, Math.floor((window.innerHeight - 72) * 0.84));

		isFilesMaximized = false;
		filesWindow.classList.remove('maximized');
		filesWindow.style.display = 'flex';
		filesWindow.style.position = 'fixed';
		filesWindow.style.width = safeWidth + 'px';
		filesWindow.style.height = safeHeight + 'px';
		filesWindow.style.top = Math.max(0, Math.floor((window.innerHeight - 72 - safeHeight) / 2)) + 'px';
		filesWindow.style.left = '50%';
		filesWindow.style.right = 'auto';
		filesWindow.style.bottom = 'auto';
		filesWindow.style.transform = 'translateX(-50%)';
		filesWindow.style.borderRadius = '1rem';
		filesWindow.style.resize = 'both';

		const btn = document.getElementById('filesMaxBtn');
		if (btn) btn.innerHTML = '<i class="fa-regular fa-square"></i>';
	}

	function openFilesMaximized() {
		isFilesMaximized = true;
		filesWindow.classList.add('maximized');
		filesWindow.style.display = 'flex';
		filesWindow.style.position = 'fixed';
		filesWindow.style.width = '100%';
		filesWindow.style.height = 'calc(100vh - 72px)';
		filesWindow.style.top = '0';
		filesWindow.style.left = '0';
		filesWindow.style.transform = 'none';
		filesWindow.style.borderRadius = '0';
		filesWindow.style.resize = 'none';

		const btn = document.getElementById('filesMaxBtn');
		if (btn) btn.innerHTML = '<i class="fa-regular fa-window-restore"></i>';
	}

	function clampFilesIntoViewport() {
		if (isFilesMaximized) return;

		const rect = filesWindow.getBoundingClientRect();
		let left = rect.left;
		let top = rect.top;
		const maxLeft = Math.max(0, window.innerWidth - rect.width);
		const maxTop = Math.max(0, (window.innerHeight - 72) - rect.height);

		left = Math.max(0, Math.min(left, maxLeft));
		top = Math.max(0, Math.min(top, maxTop));

		filesWindow.style.left = left + 'px';
		filesWindow.style.top = top + 'px';
		filesWindow.style.transform = 'none';
	}

	function minimizeFilesWindow() {
		sendFilesMessage('focus');
		sendFilesMessage('minimize', { mode: isFilesMaximized ? 'maximized' : 'floating' });
	}

	function toggleMaximizeFilesWindow() {
		sendFilesMessage('focus');
		isFilesMaximized = !isFilesMaximized;
		if (isFilesMaximized) {
			openFilesMaximized();
			sendFilesMessage('maximize');
		} else {
			openFilesFloating();
			sendFilesMessage('restore');
		}
	}

	function closeFilesWindow() {
		sendFilesMessage('focus');
		sendFilesMessage('close');
	}

	window.addEventListener('message', (event) => {
		if (!event.data || !event.data.type) return;
		if (event.data.app && event.data.app !== 'files') return;

		if (event.data.type === 'openFloating') {
			openFilesFloating();
		} else if (event.data.type === 'openMaximized') {
			openFilesMaximized();
		}
	});

	filesHeader.addEventListener('mousedown', (event) => {
		if (event.target.closest('.window-controls') || isFilesMaximized) return;
		isFilesDragging = true;
		sendFilesMessage('focus');
		const rect = filesWindow.getBoundingClientRect();
		filesDragOffsetX = event.clientX - rect.left;
		filesDragOffsetY = event.clientY - rect.top;
	});

	filesResizeHandle.addEventListener('mousedown', (event) => {
		event.stopPropagation();
		if (isFilesMaximized) return;
		isFilesResizing = true;
		sendFilesMessage('focus');
		const rect = filesWindow.getBoundingClientRect();
		filesStartX = event.clientX;
		filesStartY = event.clientY;
		filesStartW = rect.width;
		filesStartH = rect.height;
	});

	document.addEventListener('mousemove', (event) => {
		if (isFilesDragging && !isFilesMaximized) {
			const rect = filesWindow.getBoundingClientRect();
			const maxLeft = Math.max(0, window.innerWidth - rect.width);
			const maxTop = Math.max(0, (window.innerHeight - 72) - rect.height);
			const left = Math.max(0, Math.min(event.clientX - filesDragOffsetX, maxLeft));
			const top = Math.max(0, Math.min(event.clientY - filesDragOffsetY, maxTop));
			filesWindow.style.left = left + 'px';
			filesWindow.style.top = top + 'px';
			filesWindow.style.transform = 'none';
		}

		if (isFilesResizing && !isFilesMaximized) {
			const rect = filesWindow.getBoundingClientRect();
			const maxWidth = Math.max(FILES_MIN_WIDTH, window.innerWidth - rect.left);
			const maxHeight = Math.max(FILES_MIN_HEIGHT, (window.innerHeight - 72) - rect.top);
			const width = Math.min(maxWidth, Math.max(FILES_MIN_WIDTH, filesStartW + (event.clientX - filesStartX)));
			const height = Math.min(maxHeight, Math.max(FILES_MIN_HEIGHT, filesStartH + (event.clientY - filesStartY)));
			filesWindow.style.width = width + 'px';
			filesWindow.style.height = height + 'px';
		}
	});

	document.addEventListener('mouseup', () => {
		isFilesDragging = false;
		isFilesResizing = false;
	});

	filesWindow.addEventListener('mousedown', () => sendFilesMessage('focus'));
	window.addEventListener('resize', clampFilesIntoViewport);

	async function bootstrapFilesApp() {
		await loadFilesDataFromApi();
		renderFolderGrid();
		openFilesFloating();

		document.getElementById('uploadImageInput')?.addEventListener('change', async () => {
			const file = document.getElementById('uploadImageInput').files?.[0];
			if (!file) {
				setUploadPreview('');
				return;
			}
			const dataUrl = await fileToDataURL(file);
			setUploadPreview(dataUrl);
		});

		document.getElementById('unlockPasswordInput')?.addEventListener('keydown', (event) => {
			if (event.key === 'Enter') {
				submitUnlockFile();
			}
		});
	}

	bootstrapFilesApp();

	window.ArchivosApp = {
		openFloating: openFilesFloating,
		openMaximized: openFilesMaximized,
	};
</script>
