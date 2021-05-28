import React, { Component } from 'react'
import axios from 'axios'
import { Button } from 'react-bootstrap'

class PostApiDispo extends Component {
    constructor(props) {
        super(props)

        this.state = {
            date_rdv: '',
            statut: 'libre'
        }
    }

    bonneValeur(date){/*
    
        axios.get('/api/dispo_all/get')
            .then(response => {
                    console.log(response.data)
                })*/
        if(document.getElementById("inputH").value ==""){
            return false
        }
        return true
    }

    changeHandler = (e) => {
        this.setState({ [e.target.name]: e.target.value })
    }

    submitHandler = e => {
        e.preventDefault()
        if(this.bonneValeur(this.state.date_rdv)){
            axios.post('/api/dispo/post', this.state)
                .then(response => {
                    let data = new Array();
                    data.push(this.state)
                })
                .catch(error => {
                    null //une erreur s'est produite
                })
            axios.get('/api/dispo/get', this.state)
                .then(response => {
                    this.renderTable(response.data)
                })
            document.getElementById('msg').innerHTML = '<p variation="success" style={{margin: "3%"}}>La nouvelle disponibilité a bien été encodée.</p>'
        }
        else{
            document.getElementById('msg').innerHTML = '<p variation="danger" style={margin: "3%"}}>Cette plage horaire n\'est pas valide ou disponible. Veuillez choisir une plage horaire d\'une durée d\'une heure qui n\'est pas déjà prise et qui ne chevauche pas une autre plage horaire déjà prise.</p>'
        }
    }

    renderTable(données) {
        données = données.map(champ => 
           champ = {dateRdv : champ.dateRdv.substring(8,10) + '/' + champ.dateRdv.substring(5,7) + ' ' + champ.dateRdv.substring(11,16), jour : champ.dateRdv.substring(8,10), mois : champ.dateRdv.substring(5,7), heure : champ.dateRdv.substring(11,16), annee : champ.dateRdv.substring(0,4)}
        ).sort((a, b) => new Date(...a.dateRdv.split('/').reverse()) - new Date(...b.dateRdv.split('/').reverse()))
        return document.getElementById('trAffichage').innerHTML = données.map(champ => {
            return (
                '<td>' + champ.dateRdv + '</td>'
            )
        }).join('')
    }
    
    render() {
        const { date_rdv } = this.state
        return (
            <div>
                <h1 style={{fontFamily: 'rockwell', fontSize: '350%', marginBottom: '1%', color: "teal"}}>Prise de rendez-vous</h1>
                <input style={{marginLeft: '10%'}} id="inputH" type="datetime-local" name="date_rdv" value={date_rdv} onChange={this.changeHandler} />
                <Button onClick={this.submitHandler} style={{margin: '2%'}}>Ajouter des disponibilites</Button>
                <div id="msg"></div>
            </div>
        )
    }
}
export default PostApiDispo;