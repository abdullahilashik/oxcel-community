@props(['categories'])

<section class="bg-gray-900 text-white w-full">
    <div class="container h-full">
        <div x-data="searchForm()" class="flex flex-col  items-center justify-center h-full min-h-[500px] max-w-[820px] mx-auto">
            <h1 class="text-7xl font-bold">Brokers' Community</h1>
            <p class="text-2xl">Discover insights, share expertise, elevate your network</p>
            <form @submit.prevent action="#" class="bg-white rounded shadow-md w-full inline-flex items-center justify-between p-3 mt-8 relative overflow-x-clip">
                <div class="inline-flex  items-center gap-1 flex-1">
                    <img src="{!! asset('assets/icons/search.svg') !!}" alt="">
                    <input
                        x-model="query"
                        @input="debouncedFetchData"
                        id="search-input"
                        type="text" placeholder="Search for posts.."
                        class="flex-1 outline-none text-black px-2">
                </div>
                <select
                    x-model="filter"
                    @change="debouncedFetchData"
                    name="#" id="category-select"
                    class="text-black border-l-2 border-gray-900 pl-2 outline-none">
                    <option value="">All Category</option>
                    @if ($categories)
                        @foreach ($categories as $category)
                            <option value="{{$category->slug}}">{{$category->title}}</option>
                        @endforeach
                    @endif
                </select>
                <div x-show="query || filter" class="w-full border-2 top-[110%] left-0 absolute max-h-[200px] overflow-y-auto">
                    <ul x-show="results.length > 0" class="flex flex-col text-black divide-y-2 bg-white">
                        <template x-for="result in results" :key="result.id">
                            <a href="#" :href="'/posts/'+result.slug">
                                <li class="flex flex-col gap-2 hover:bg-gray-100 p-2">
                                    <div class="flex items-center justify-between">
                                        <h4 x-text="result.title"></h4>
                                        <div class="flex items-center text-[10px] divide-x-2 space-x-4">
                                            <span>Posted by: <span><span x-text="result.user.fname"></span> <span x-text="result.user.lname"></span></span></span>
                                            <span class="pl-4" x-text="result.created_at"></span>
                                        </div>
                                    </div>
                                    <article class="text-[10px]" x-html="result.description" data-limit="120"></article>
                                </li>
                            </a>
                        </template>
                    </ul>
                    <span x-show="loading" class="mx-auto bg-white text-black w-full flex justify-center p-4">
                        Please wait....
                    </span>
                    <span x-show="!loading && results.length < 1" class="mx-auto bg-white text-black w-full flex justify-center p-4">
                        No data for this search
                    </span>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    function searchForm() {
        return {
            query: '', // Holds the search input value
            filter: '', // Holds the selected filter value
            results: [], // Array to store the API results
            loading: false,
            debounceTimeout: null, // Timeout variable for debounce

            // Debounced method to fetch data
            debouncedFetchData() {
                // Clear the existing timeout if the user continues typing
                clearTimeout(this.debounceTimeout);

                // Set a new timeout for 500ms before calling the fetchData method
                this.debounceTimeout = setTimeout(() => {
                    this.loading = true;
                    // this.results = [];
                    this.fetchData();
                }, 500);
            },

            // Method to fetch data from the API
            async fetchData() {
                try {
                    // Call the API with query and filter
                    const response = await fetch(`/api/posts/search?query=${this.query}&filter=${this.filter}`);
                    const data = await response.json();

                    // Update the results array with fetched data
                    this.results = data;
                    console.log('Result data: ', this.results);
                    this.loading = false;
                } catch (error) {
                    console.error("Error fetching data:", error);
                    this.results = [];
                    this.loading = false;
                }
            }
        }
    }
</script>
