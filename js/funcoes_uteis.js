function tratarString(str) {
    var rep = '-';
    str = str.toLowerCase().replace(/\s+/g, rep);

    var from = 'àáäâãèéëêìíïîõòóöôùúüûñç';
    var to = 'aaaaaeeeeiiiiooooouuuunc';
    for (var i = 0, l = from.length; i < l; i++) {
        str = str.replace(
                new RegExp(from.charAt(i), 'g'),
                to.charAt(i)
                );
    }
    str = str.replace(/\+/g, '-');
    str = str.replace(/---/g, '-');
    str = str.replace('/', '-');
    str = str.replace(',', '');
    return str;
}