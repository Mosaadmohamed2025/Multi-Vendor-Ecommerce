<script>
    // auto search
    document.addEventListener('DOMContentLoaded', function () {
        var path = "{{ route('autosearch') }}";
        var searchInput = document.getElementById('search_text');
        var resultsDropdown = document.getElementById('search_results_dropdown');

        searchInput.addEventListener('input', function () {
            var term = searchInput.value;

            fetch(path + '?term=' + term)
                .then(response => response.json())
                .then(data => {
                    updateAutocomplete(data);
                    toggleDropdown();
                })
                .catch(error => console.error('Error fetching autocomplete data:', error));
        });

        // Update input value when an option is selected
        resultsDropdown.addEventListener('input', function () {
            searchInput.value = resultsDropdown.value;
            toggleDropdown(); // Hide the dropdown after selection
            resultsDropdown.style.display = 'none'; // Hide the dropdown after selection

        });

        function updateAutocomplete(data) {
            resultsDropdown.innerHTML = ''; // Clear previous results

            if (data.length > 0) {
                data.forEach(function (item) {
                    var option = document.createElement('option');
                    option.value = item.value;
                    option.text = item.value;
                    resultsDropdown.appendChild(option);
                });
            } else {
                var option = document.createElement('option');
                option.text = 'No results found';
                resultsDropdown.appendChild(option);
            }
        }

        function toggleDropdown() {
            var hasOptions = resultsDropdown.options.length > 0;
            resultsDropdown.style.display = hasOptions && searchInput.value.trim() !== '' ? 'block' : 'none';

            // Dynamically set the size attribute to show more options without a scrollbar
            resultsDropdown.size = Math.min(10, resultsDropdown.options.length); // Adjust the number of visible options
        }
    });


    //mobile autosearch

    document.addEventListener('DOMContentLoaded', function () {
        var path = "{{ route('autosearch') }}";
        var searchInput = document.getElementById('mobile-search');
        var resultsDropdown = document.getElementById('search_results_dropdown_mobile');

        searchInput.addEventListener('input', function () {
            var term = searchInput.value;

            fetch(path + '?term=' + term)
                .then(response => response.json())
                .then(data => {
                    updateAutocomplete(data);
                    toggleDropdown();
                })
                .catch(error => console.error('Error fetching autocomplete data:', error));
        });

        // Update input value when an option is selected
        resultsDropdown.addEventListener('input', function () {
            searchInput.value = resultsDropdown.value;
            toggleDropdown(); // Hide the dropdown after selection
            resultsDropdown.style.display = 'none'; // Hide the dropdown after selection

        });

        function updateAutocomplete(data) {
            resultsDropdown.innerHTML = ''; // Clear previous results

            if (data.length > 0) {
                data.forEach(function (item) {
                    var option = document.createElement('option');
                    option.value = item.value;
                    option.text = item.value;
                    resultsDropdown.appendChild(option);
                });
            } else {
                var option = document.createElement('option');
                option.text = 'No results found';
                resultsDropdown.appendChild(option);
            }
        }

        function toggleDropdown() {
            var hasOptions = resultsDropdown.options.length > 0;
            resultsDropdown.style.display = hasOptions && searchInput.value.trim() !== '' ? 'block' : 'none';

            // Dynamically set the size attribute to show more options without a scrollbar
            resultsDropdown.size = Math.min(10, resultsDropdown.options.length); // Adjust the number of visible options
        }
    });


</script>
