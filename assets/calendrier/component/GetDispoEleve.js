import React, { Component } from 'react';
import axios from 'axios';
import { render } from 'react-dom';
import "../utils";
import * as ReactBootStrap from "react-bootstrap"

class GetDispoEleve extends Component {
    constructor(props) {
        super(props)

        this.state = {
            date_rdv: '',
            statut: 'libre'
        }
    }

    changeHandler = (e) => {
        this.setState({ [e.target.name]: e.target.value })
    }

    submitHandler = e => {
        e.preventDefault()
        axios.get('/api/dispo/get', this.state)
            .then(response => {
                this.renderTable(response.data)
            })
    }

    componentDidMount() {
        window.addEventListener('load', this.submitHandler);
    }    

    renderTable(données) {
        données = données.map(champ => 
           champ = {dateRdv : champ.dateRdv.substring(8,10) + '/' + champ.dateRdv.substring(5,7) + ' ' + champ.dateRdv.substring(11,16), jour : champ.dateRdv.substring(8,10), mois : champ.dateRdv.substring(5,7), heure : champ.dateRdv.substring(11,16), annee : champ.dateRdv.substring(0,4), idDate: champ.dateRdv.substring(0,16)}
        ).sort((a, b) => new Date(...a.dateRdv.split('/').reverse()) - new Date(...b.dateRdv.split('/').reverse()))
        document.getElementById('trAffichage').innerHTML = données.map(champ => {
            return (
                '<tr><td><input type="radio" id="' + champ.idDate.substring(0,16) + '" class="date" name="date" value="' + champ.dateRdv + '"> ' + champ.dateRdv + '</td></tr>'
            )
        }).join('');
        gid("form-cours").innerHTML += '<input id="math" type="radio" name="cours" value="math"> Math</input><br><input id="sciences" type="radio" name="cours" value="sciences"> Sciences</input>';
    }

    render() {
        return (
            <div>
                <div>
                <h3 style={{fontFamily: 'rockwell', fontSize: '150%', marginBottom: '1%'}}>Plages horaire disponibles : </h3>
                    <ReactBootStrap.Table responsive variant="info" striped bordered hover size="xl" id="tableSelectDate">
                        <tbody ><tr id='trAffichage'></tr></tbody>
                    </ReactBootStrap.Table>
                    <div style={{marginBottom: "2%"}} id="form-cours"></div>
                    <div id="msg"></div>
                    <div id="messageErreur"></div>
                </div>
            </div>
        )
    }
}
export default GetDispoEleve;

function gid(id) {
    return document.getElementById(id);
}