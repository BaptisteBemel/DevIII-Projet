import React, { Component } from 'react';
import axios from 'axios';
import { render } from 'react-dom';
import "../utils";

class PutDispoEleve extends Component {
    constructor(props) {
        super(props)

        this.state = {
            date_rdv: '',
            statut: 'libre',
            matiere: '',
            user: ''
        }
    }

    submitDate() {
        let messageErreur = gid("messageErreur");
        let checkboxes = document.querySelectorAll('input[name=date]:checked');
        let radios = document.querySelectorAll('input[name=cours]:checked');
        let userId = parseInt(gid("user").value);
        
        let coursCheck = false;
        let coursSelect;
        let dateCheck = false;
        let dateSelect;

        for(let rad of radios) {
            if(rad.checked) {
                coursCheck = true;
                coursSelect = rad.value;
                break;
            }
        }

        for(let box of checkboxes) {
            if(box.checked) {
                dateCheck = true;
                dateSelect = box.value;
                break;
            }
        }

        if(!dateSelect) {
            messageErreur.innerText = "Il n'y a pas de date sélectionné !";
        }
        else if(!coursCheck) {
            messageErreur.innerText = "Il n'y a pas de cours sélectionné !";
        }
        else {
            messageErreur.innerText = '';
            return [dateSelect, "occupé", coursSelect, userId];
        }
    }

    submitHandler = e => {
        var tab = this.submitDate();
        let date, statut, matiere, userId;
        date = tab[0];
        statut = tab[1];
        matiere = tab[2];
        userId = tab[3];
        let datas = {
            date_rdv: date,
            statut: statut,
            matiere: matiere,
            id: userId
        }
        axios.put('/api/dispo/put/' + date, datas)
            .then(response => {
                this.setState({
                    date_rdv: date,
                    statut: statut,
                    matiere: matiere,
                })
            })
            .catch(error => {
                console.error(error);
            })
    }

    changeHandler = (e) => {
        this.setState({ [e.target.name]: e.target.value })
    }

    render() {
        return (
            <div id="validation">
                <button onClick={this.submitHandler}>
                    Valider
                </button>
            </div>
        )
    }
}
export default PutDispoEleve;

function gid(id) {
    return document.getElementById(id);
}