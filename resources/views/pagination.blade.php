<!--<div><input type="button" onclick="filter(get_data_for_post().withPage({!!$paginator->currentPage()+1!!}))" value="Get Data For Next Page"></div><br>-->
@if ($paginator->hasPages())
<p style="display: none;" onclick="filter(get_data_for_post())">{{$glue = strpos($url, '?') ? '&' : '?'}}</p>
<nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
    {!!
    ($paginator->currentPage() == 1) ?
    '<span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">[</span>' :
    '<span onclick="filter(get_data_for_post().withPage('.($paginator->currentPage()-1).'))" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">« Назад</span>'
    !!}
    {!!
    ($paginator->nextPageUrl() == null) ?
    '<span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">]</span>' :
    '<span onclick="filter(get_data_for_post().withPage('.($paginator->currentPage()+1).'))" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">Вперёд »</span>'
    !!}
</nav>
@endif
<script>
function get_data_for_page_n(page_n) {
    const d = new PostData().withPage(page_n).build(); alert(d.page + '\n' + d.priceFrom +'\n'+ d.priceTo);
}

class PostData {
    constructor() {
        this.priceFrom = ($('.ui-slider-min').val());
        this.priceTo = ($('.ui-slider-max').val());
    }
    
    withPage(page_num) {
        this.page = page_num;
        return this;
    }
    
    build() {
        return this;
    }
    
}</script>