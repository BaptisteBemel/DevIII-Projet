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

    makeMail(numberOfMail) {
        let listMail = [];
        for(let i = 0; i < numberOfMail; i++) {
           listMail.push(React.createElement("button",
        { className: "mailButton", id: i , onClick: this.onClickButtonMail(i)},
        i));
        }
        return listMail;
    }

    onClickButtonMail(id) {
        let gidZone = gid("mailContenu");
        gidZone.innerText = id + " est votre id."
    }

    render() {
        return this.state.hasMail ? this.makeMail(15) : "";
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

//let contenu = gid("mailContenu");
//ReactDOM.render(mailContenu, contenu);

//console.log('Test Symfony !')

