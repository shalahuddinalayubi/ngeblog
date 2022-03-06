import Quill from 'quill'

var quill = new Quill('#editor', {
    theme: 'snow'
})

quill.on('text-change', (delta, oldDelta, source) => {
    document.getElementById('content').value = quill.root.innerHTML
})

window.onload = function () {
    const content = document.getElementById('content')
    if (content.value) {
        quill.root.innerHTML = content.value
    }
}
