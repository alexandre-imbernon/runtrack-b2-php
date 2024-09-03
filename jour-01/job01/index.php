<?php
function my_str_search(string $needle, string $haystack) : int {
    $occurrences = substr_count($haystack, $needle);
        return $occurrences;
}
echo my_str_search('a', 'La Plateforme');
?>