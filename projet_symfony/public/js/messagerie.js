function gid(id) {
    return document.getElementById(id);
}

class messages extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            isConnected: 0,
            whoIsIt: 0, //0 == non-conecté, 1 == élève, 2 == professeur
            hasMail: 1 //0 == non, 1 == oui
        }
    }

    /*makeMail(numberOfMail) {
        for(let i = 0; i < numberOfMail; i++) {
            React.createElement("button",
        { className: "mailButton" },
        i)
        } 
    }*/

    render() {
        return this.state.hasMail ? React.createElement("button",
        { className: "mailButton" },
        "Bouton") : ""; 
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
ReactDOM.render(React.createElement(messages), mail);

let contenu = gid("mailContenu");
ReactDOM.render(mailContenu, contenu);