import React, { Component } from 'react'
import axios from 'axios'
import { Button, ToggleButton } from 'react-bootstrap'

class PostApiDispo extends Component {
    constructor(props) {
        super(props)

        this.state = {
            date_rdv: '',
            statut: 'libre'
        }
    }

    bonneValeur(dates){
        let valeurTest = document.getElementById("inputH").value
        //Si pas de date sélectionnée -> return false
        if(valeurTest == ""){
            return false
        }
        valeurTest= valeurTest.substring(0, 10) + " " + valeurTest.substring(11) + ":00"
        let anneeTest = valeurTest.substring(0, 4)
        let moisTest = valeurTest.substring(5, 7)
        let jourTest = valeurTest.substring(8, 10)
        let heureTest = valeurTest.substring(11, 13)
        let minTest = valeurTest.substring(14, 16)

        let erreur

        dates.forEach(date => {
            let anneeDate = date.dateRdv.substring(0, 4)
            let moisDate = date.dateRdv.substring(5, 7)
            let jourDate = date.dateRdv.substring(8, 10)
            let heureDate = date.dateRdv.substring(11, 13)
            let minDate = date.dateRdv.substring(14, 16)
            //même année - milieu d'année
            if(anneeDate == anneeTest){
                //même mois - milieu de mois
                if(moisDate == moisTest){
                    //même jour - milieu de jour
                    if(jourDate == jourTest){
                        //cas à refuser
                        if(heureDate == heureTest || heureDate - heureTest == 1 && minDate < minTest || heureDate - heureTest == -1 && minDate > minTest){
                            erreur = true
                        }
                    }
                    //changement de jour (si travail de nuit)
                    else if(jourDate != jourTest){
                        if(heureDate == '23' && heureTest == '00' && minDate > minTest || heureDate == '00' && heureTest == '23' && minDate < minTest){
                            erreur = true
                        }
                    }
                }
                //changement de mois
                else if(moisDate != moisTest){
                    moisLong = ['01', '03', '05', '07', '08', '10', '12']
                    moisCourt = ['04', '06', '09', '11']
                    fevrier = '02'
                    //mois de 31j
                    if(moisDate in moisLong && jourDate == '31' && jourTest == '01' && heureDate == '23' && heureTest == '00' && minDate > minTest || moisTest in moisLong && jourDate == '01' && jourTest == '31' && heureDate == '00' && heureTest == '23' && minDate < minTest){
                        erreur = true
                    }
                    //mois de 30j
                    else if(moisDate in moisCourt && jourDate == '30' && jourTest == '01' && heureDate == '23' && heureTest == '00' && minDate > minTest || moisTest in moisCourt && jourDate == '01' && jourTest == '30' && heureDate == '00' && heureTest == '23' && minDate < minTest){
                        erreur = true
                    }
                    //février
                    else if(moisDate == '02' && jourDate == '28' && jourTest == '01' && heureDate == '23' && heureTest == '00' && minDate > minTest || moisTest == '02' && jourDate == '01' && jourTest == '28' && heureDate == '00' && heureTest == '23' && minDate < minTest){
                        erreur = true
                    }
                    //février bissextile
                    else if(moisDate == '02' && jourDate == '29' && jourTest == '01' && heureDate == '23' && heureTest == '00' && minDate > minTest || moisTest == '02' && jourDate == '01' && jourTest == '29' && heureDate == '00' && heureTest == '23' && minDate < minTest){
                        erreur = true
                    }
                }
            }
            //changement d'année
            else if(anneeDate != anneeTest){
                if(moisDate == '12' && moisTest == '01' && jourDate == '31' && jourTest == '01' && heureDate == '23' && heureTest == '00' && minDate > minTest || moisDate == '01' && moisTest == '12' && jourDate == '01' && jourTest == '31' && heureDate == '00' && heureTest == '23' && minDate < minTest){
                    erreur = true
                }
            }
        });
        if(erreur){
            return false
        }
        return true
    }

    changeHandler = (e) => {
        this.setState({ [e.target.name]: e.target.value })
    }

    submitHandler = e => {
        e.preventDefault()
        document.getElementById('msg').innerHTML = ''
        document.getElementById('messageErreur').innerHTML = ''
        axios.get('/all', this.state)
            .then(response => {
                if(this.bonneValeur(response.data)){
                    axios.post('/api/dispo/post', this.state)
                        .then(response => {
                            let data = new Array()
                            data.push(this.state)
                            axios.get('/api/dispo/get', this.state)
                            .then(response => {
                                this.renderTable(response.data)
                        })
                        })
                        .catch(error => {
                            //une erreur s'est produite
                            null
                        })
                    document.getElementById('msg').innerHTML = '<p variation="success" style={{margin: "3%"}}>La nouvelle disponibilité a bien été encodée.</p>'
                }
                else{
                    document.getElementById('messageErreur').innerHTML = '<p variation="danger" style={margin: "3%"}}>Cette plage horaire n\'est pas valide ou disponible. Veuillez choisir une plage horaire d\'une durée d\'une heure qui n\'est pas déjà prise et qui ne chevauche pas une autre plage horaire déjà prise.</p>'
                }
            })
            
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