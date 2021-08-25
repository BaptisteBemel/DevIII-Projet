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
                coursSelect = rad.id;
                break;
            }
        }

        for(let box of checkboxes) {
            if(box.checked) {
                dateCheck = true;
                dateSelect = box.id;
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
        console.log(tab);
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
        console.log(datas);
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
        axios.get('/api/dispo/get', this.state)
            .then(response => {
                this.renderTable(response.data)
            })
    }

    renderTable(données) {
        données = données.map(champ => 
           champ = {dateRdv : champ.dateRdv.substring(8,10) + '/' + champ.dateRdv.substring(5,7) + ' ' + champ.dateRdv.substring(11,16), jour : champ.dateRdv.substring(8,10), mois : champ.dateRdv.substring(5,7), heure : champ.dateRdv.substring(11,16), annee : champ.dateRdv.substring(0,4), idDate: champ.dateRdv.substring(0,16)}
        ).sort((a, b) => new Date(...a.dateRdv.split('/').reverse()) - new Date(...b.dateRdv.split('/').reverse()))
        document.getElementById('trAffichage').innerHTML = données.map(champ => {
            return (
                '<tr><td><input type="radio" id="' + champ.idDate.substring(0,16) + '" class="date" name="date" value="' + champ.dateRdv + '"> ' + champ.dateRdv + '</td></tr>'
            )
        }).join('')
        gid("trAffichage").innerHTML += '<tr><td><input id="math" type="radio" name="cours" value="math"> Math</input></td></tr><tr><td><input id="sciences" type="radio" name="cours" value="sciences"> Sciences</input></td><tr>';
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