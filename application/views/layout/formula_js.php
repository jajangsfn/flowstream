<script>

function double_discount(discount, total) {
    //check discount
    if (discount!="") {
        //check split
        var check_splits = check_split(discount, '+');

        if (check_splits) {
            //split diskon
            var split_discount = discount.split("+");
            //check split
            if (split_discount.length > 1) {
                //loop diskon
                $.each(split_discount, function(idx, val) {
                    //trim space and convert to float
                    nominal_discount = parseFloat(val.trim());        
                    //calculate diskon
                    total = total - (total * (nominal_discount / 100));
                });
                
            }else {
                total = total - (total * (discount/100));            
            }
        }else {
            total = total - (total * (discount/100));            
        }
        
    }
    
    return total;
    
}

function check_split(str, token) {
    str = str + '';
    return str.split(token).length > 1;
}
</script>