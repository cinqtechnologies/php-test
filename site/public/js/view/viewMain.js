class ViewMain{
    _formatPrefix(prefix) {
        let prefixLength = prefix.length;
        let zero = "";

        //get the zeros before the prefix
        for (let i = prefixLength; i < 2; i++) {
            zero += "0";
        }

        //concate the new prefix
        prefix = zero != "" ? zero + prefix : prefix;

        return prefix;
    }

    _formatNumber(number){
        let numberLength = number.length;

        if(numberLength == 9){
            number = number.substr(0, 5) + "-" + number.substr(5, 4);
        }else if(numberLength == 8){
            number = number.substr(0, 4) + "-" + number.substr(4, 4);
        }

        return number;
    }
}