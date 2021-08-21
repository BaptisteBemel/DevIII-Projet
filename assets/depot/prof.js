import React, { Component } from 'react'
import axios from 'axios'
import { render } from 'react-dom'
import * as ReactBootStrap from "react-bootstrap"

function gid(id) {
    return document.getElementById(id);
}

class DepotProf extends Component {
    constructor(props) {
        super(props)

        this.state = {
            emailAddress: "",
            title: "",
            description: "",
            ClosingDate: "",
            isOpen: false
        }
    }

    isAgree() {
        if(window.confirm("Souhaitez vous réellement ouvrir ce dépôt pour Michel ?")) {
            gid("error-p").innerText = "";
            let mailValue = gid("email").value;
            let titreValue = gid("titre").value;
            let dateValue = gid("date").value;

            //Vérifications des champs vides (utiles) ou mauvais
            if(mailValue.length < 3) {
                gid("error-p").innerText = "Adresse trop courte !";
                return "Adresse trop courte";
            }
            if(mailValue[0] == "@") {
                gid("error-p").innerText = "L'adresse mail ne peut pas commencer par le signe '@' !";
                return "Ne peut pas commencer par un '@' !";
            }
            else if(mailValue[mailValue.length - 1] == "@") {
                gid("error-p").innerText = "L'adresse mail ne peut pas terminer par le signe '@' !";
                return "Ne peut pas terminer par un '@' !";
            }

            if(titreValue.length < 1) {
                gid("error-p").innerText = "Il manque un titre !";
                return "Il manque un titre !";
            }
            if(dateValue.length < 1) {
                gid("error-p").innerText = "Il manque une date !";
                return "Il manque une date !";
            }

            for(let i in mailValue) {
                if(mailValue[i] == "@") {
                    break;
                }
                else if(mailValue.length -1 == i && mailValue[i] != "@") {
                    gid("error-p").innerText = "L'adresse mail est mauvaise, il faut au minium le signe '@' !";
                    return "L'adresse mail est mauvaise, il faut au minium le signe '@' !";
                }
            }
            
        }
    }

    render() {
        return (
            <div className="depot-cadre">
                <div class="mb-3">
                    <label className="form-label">Adresse mail</label>
                    <input id="email" type="email" className="form-control" placeholder="eleve@adresse.com"></input>
                </div>
                <div class="mb-3">
                    <label className="form-label">Titre du dépôt</label>
                    <input id="titre" type="text" className="form-control"></input>
                </div>
                <div class="mb-3">
                    <label className="form-label">Description (max. 255 caractères)</label>
                    <textarea className="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label className="form-label">Date de fermeture du dépôt</label>
                    <input id="date" style={{width: 200}} className="form-control" type="datetime-local" name="date_rdv"></input>
                </div>
                <button className="btn btn-primary" type="submit" onClick={this.isAgree}>Ouvrir le dépôt</button>
                <p id="error-p" className="text-danger" style={{marginTop: "20px"}}>
                </p>
            </div>
        )
    }
}

export default DepotProf;