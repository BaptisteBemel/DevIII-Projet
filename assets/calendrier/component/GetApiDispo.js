import React, { Component } from 'react'
import axios from 'axios'
import { render } from 'react-dom'
import * as ReactBootStrap from "react-bootstrap"
import { Button, ToggleButton } from 'react-bootstrap'

class GetApiDispo extends Component {
    constructor(props) {
        super(props)

        this.state = {
            date_rdv: '',
            statut: 'libre'
        }
    }

    données

    changeHandler = (e) => {
        this.setState({ [e.target.name]: e.target.value })
    }

    submitHandler = e => {
        e.preventDefault()
        axios.get('/dispo', this.state)
            .then(response => {
                this.renderTable(response.data)
                this.données = response.data
            })
    }

    submitDate() {
        let messageErreur = document.getElementById("messageErreur");
        let checkboxes = document.querySelectorAll('input[name=date]:checked');
        
        let dateCheck = false;
        let dateSelect;

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
        else {
            messageErreur.innerText = '';
            return dateSelect;
        }
    }

    submitHandler1 = e => {
        document.getElementById('msg').innerHTML = ''
        document.getElementById('messageErreur').innerHTML = ''
        let date = this.submitDate();
        if(date == undefined){
            return false
        }
        axios.delete('/dispo/' + date)
            .then(response => {
                this.setState({
                    date_rdv: '',
                    statut: 'libre',
                })
                axios.get('/dispo', this.state)
                .then(response => {
                    this.renderTable(response.data)
                })
                document.getElementById('msg').innerHTML = 'La plage horaire a été supprimée'
            })
            .catch(error => {
                //console.error(error);
            })
    }

    componentDidMount() {
        window.addEventListener('load', this.submitHandler);
    }    

    renderTable(données) {
        données = données.map(champ => 
           champ = {dateRdv : champ.dateRdv.substring(8,10) + '/' + champ.dateRdv.substring(5,7) + ' ' + champ.dateRdv.substring(11,16), jour : champ.dateRdv.substring(8,10), mois : champ.dateRdv.substring(5,7), heure : champ.dateRdv.substring(11,16), annee : champ.dateRdv.substring(0,4), idDate: champ.dateRdv.substring(0,16)}
        ).sort((a, b) => new Date(...a.dateRdv.split('/').reverse()) - new Date(...b.dateRdv.split('/').reverse()))
        return document.getElementById('trAffichage').innerHTML = données.map(champ => {
            return (
                '<td><input type="radio" id="' + champ.idDate.substring(0,16) + '" class="date" name="date" value="' + champ.dateRdv + '"> ' + champ.dateRdv + '</td>'
            )
        }).join('')
    }

    render() {
        return (
            <div>
                <div>
                    <h3 style={{fontFamily: 'rockwell', fontSize: '150%', marginBottom: '1%'}}>Plages horaire disponibles: </h3>
                    <ReactBootStrap.Table responsive variant="info" striped bordered hover size="xl">
                        <tbody ><tr id='trAffichage'></tr></tbody>
                    </ReactBootStrap.Table>
                    <Button onClick={this.submitHandler1} style={{margin: '2%'}}>Supprimer des disponibilites</Button>
                </div>
                <div id="msg"></div>
                <div id="messageErreur"></div>
            </div>
        )
    }
}
export default GetApiDispo;