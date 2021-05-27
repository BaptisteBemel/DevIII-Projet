import React, { Component } from 'react'
import axios from 'axios'

function affichage(données){
    document.getElementById('titre').innerHTML = '<th>Plages horaire disponibles</th>';
    document.getElementById('tbAffichage').innerHTML = '';
    données.forEach(x => {
        document.getElementById('tbAffichage').innerHTML += '<tr>'+ x.dateRdv.substring(0,16) + '</tr>'
    })
}

function bonneValeur(date){
    null //pas la même heure, pas - de une heure après une dispo ou un cours, pas - de une heure après maintenant (sauf si trop dure), pas vide ni partiellement vide - si erreur message + return false - si ok return true et message à rajouter à la fin du if dans le submit
    //document.getElementById('msg').innerHTML = '' voir si react
    //document.getElementById('msg').innerHTML = 'Cette plage horaire n\'est pas disponible. Veuillez choisir une plage horaire d\'une durée d\'une heure qui n\est pas déjà prise et qui ne chevauche pas une autre plage horaire déjà prise.'
}

class PostApiDispo extends Component {
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
        bonneValeur(this.state.date_rdv)
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
                affichage(response.data)
            })
    }
    
    render() {
        const { date_rdv } = this.state
        return (
            <div>
                <input type="datetime-local" name="date_rdv" value={date_rdv} onChange={this.changeHandler} />
                <button onClick={this.submitHandler}>Ajouter des disponibilites</button>
                <div id="msg"></div>
            </div>
        )
    }
}
export default PostApiDispo;