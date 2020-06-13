<script>
    $(document).ready(() => {
        $("#s_reference_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            columnDefs: [{
                    responsivePriority: 2,
                    targets: -1
                },
                {
                    targets: -1,
                    orderable: false,
                },
                {
                    targets: 0,
                    orderable: false,
                },
            ],
            "drawCallback": function(settings) {
                if ($("#s_reference_table").DataTable().row().data() !== undefined) {
                    $("tbody td:first-child").each(function(index, elem) {
                        $(elem).text(index + 1);
                    })
                }
            },
        })

        $('.select2').select2({
            width: '100%'
        });

        $(".group_data_suggest").typeahead({
            hint: true,
            minLength: 1
        }, {
            name: "group_data",
            source: substringMatcher(group_data)
        })


    })
    var group_data = [
        <?php foreach ($group_data as $entry) {
            echo "'" . $entry['group_data'] . "',";
        } ?>
    ];

    var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });

            cb(matches);
        }
    }
</script>