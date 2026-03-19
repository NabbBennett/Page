<div class="image-viewer-backdrop" id="imageViewerModal" onclick="closeImageViewer()">
	<div class="image-viewer-content" onclick="event.stopPropagation()">
		<button type="button" class="image-viewer-close" onclick="event.stopPropagation(); closeImageViewer()"><i class="fa-solid fa-xmark"></i></button>
		<img id="imageViewerImg" class="image-viewer-img" alt="Vista previa" />
	</div>
</div>
