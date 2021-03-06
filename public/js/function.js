function newWindow(link, myname, w, h, features) {
    var winl = (screen.width - w) / 2;
    var wint = (screen.height - h) / 2;
    if (winl < 0) winl = 0;
    if (wint < 0) wint = 0;
    var settings = 'height=' + h + ',';
    settings += 'width=' + w + ',';
    settings += 'top=' + wint + ',';
    settings += 'left=' + winl + ',';
    settings += features;
    win = window.open(link, myname, settings);
    win.window.focus();
}

function UpperCaseFirstLetter(str) {
    return str.replace(/\w\S*/g, function(txt) { return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); });
}
window.livewire.on('alert', param => {
    iziToast[param['type']]({ title: UpperCaseFirstLetter(param['type']), message: param['message'], position: 'bottomRight' });
});