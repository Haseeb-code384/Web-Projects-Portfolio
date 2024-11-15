  <script>
        function generate_patient_id(x)
        {
            document.getElementsByName("patient_id")[0].value = x;
        }
    </script>
<i onClick="generate_patient_id('<?php echo get_next_patient_id(); ?>')" class="fa fa-list-ol fa-2x" title="Generate Patient Id"></i>

