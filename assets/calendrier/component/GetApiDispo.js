import React, { Component } from 'react'
import axios from 'axios'
import { render } from 'react-dom'
import * as ReactBootStrap from "react-bootstrap"
/*
function affichage(données){
    document.getElementById('titre').innerHTML = '<th>Plages horaire disponibles</th>';
    document.getElementById('tbAffichage').innerHTML = '';
    données.forEach(x => {
        document.getElementById('tbAffichage').innerHTML += '<tr><td>' + x.dateRdv.substring(0,16) + '</td></tr>'
    })
}*/

class GetApiDispo extends Component {
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
           champ = {dateRdv : champ.dateRdv.substring(8,10) + '/' + champ.dateRdv.substring(5,7) + ' ' + champ.dateRdv.substring(11,16), jour : champ.dateRdv.substring(8,10), mois : champ.dateRdv.substring(5,7), heure : champ.dateRdv.substring(11,16), annee : champ.dateRdv.substring(0,4)}
        ).sort((a, b) => new Date(...a.dateRdv.split('/').reverse()) - new Date(...b.dateRdv.split('/').reverse()))
        return document.getElementById('tbAffichage').innerHTML = données.map(champ => {
            return (
                '<tr><td>' + champ.dateRdv + '</td></tr>'
            )
        }).join('')
    }
    
    render() {
        return (
            <div>
                <div>
                    <ReactBootStrap.Table>
                        <thead>
                            <tr id='titre'>
                            </tr>
                        </thead>
                        <tbody id='tbAffichage'></tbody>
                    </ReactBootStrap.Table>
                </div>
            </div>
        )
    }
}
export default GetApiDispo;