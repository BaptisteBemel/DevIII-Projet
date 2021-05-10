class CommentsElement extends HTMLElement {

    connectedCallback(){
        this.innerHTML = "Bonjour tout le monde"
    }
}

// Uncaught TypeError: Failed to execute 'define' on 'CustomElementRegistry': parameter 2 is not of type 'Function'.