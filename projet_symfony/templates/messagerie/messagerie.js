function gid(id) {
    return document.getElementById(id);
}

class messages extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            isConnected: 0,
            whoIsIt: 0 //0 == non-conecté, 1 == élève, 2 == professeur
        }
    }

    render() {
        return React.createElement(button,
        {id: "id"},
        "Bouton");
    }
}

class mailContenu extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            isConnected: 0,
            whoIsIt: 0 //0 == non-conecté, 1 == élève, 2 == professeur
        }
    }

    render() {
        return pass;
    }
}

let mail = gid("mailList");
ReactDOM.render(new messages(), mail);

let contenu = gid("mailContenu");
ReactDOM.render(mailContenu, contenu);