<div class="tablenav-pages">
	<span class="displaying-num">{{meta.total}} items</span>
			<span class="pagination-links">
				<a class="first-page" data-ng-class="{disabled:(meta.currentPage < 2 || loading)}" title="Go to the first page" href="javascript:void(null);" data-ng-click="setLocationPage(1, meta.limit)">«</a>
				<a class="prev-page" data-ng-class="{disabled:(meta.currentPage < 2 || loading)}" title="Go to the previous page" href="javascript:void(null);" data-ng-click="setLocationPage(meta.currentPage - 1, meta.limit)">‹</a>
				<span class="paging-input">{{meta.currentPage}} of <span class="total-pages">{{meta.totalPages}}</span></span>
				<a class="next-page" data-ng-class="{disabled:(meta.currentPage >= meta.totalPages || loading)}" title="Go to the next page" href="javascript:void(null);" data-ng-click="setLocationPage(meta.currentPage + 1, meta.limit)">›</a>
				<a class="last-page" data-ng-class="{disabled:(meta.currentPage >= meta.totalPages || loading)}" title="Go to the last page" href="javascript:void(null);" data-ng-click="setLocationPage(meta.totalPages, meta.limit)">»</a>
			</span>
</div>
<br class="clear">