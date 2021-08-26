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
            emailAdress: "",
            title: "",
            description: "",
            file_name: "",
            file: null
        }
    }

    changeHandler = (e) => {
        this.setState({ [e.target.name]: e.target.value })
    }

    getData() {
        return [gid("email").value, gid("titre").value, gid("description").value, gid("file").value];
    }

    getFileName(name) {
        let transformedName = name.split("//");
        let finalName = transformedName[0].split("\\");
        return finalName[finalName.length - 1];
    }

    onFileChange = event => {
        this.setState({ file: event.target.files[0] });
    }

    submitHandler = e => {
        if(this.isAgree()) {
            var tab = this.getData();
            var name = this.getFileName(tab[3]);

            let mail, title, desc, fileName;
            mail = tab[0];
            title = tab[1];
            desc = tab[2];
            fileName = name;

            let datas = {
                emailAdress: mail,
                title: title,
                description: desc,
                file_name: fileName,
                file: this.state.file
            }

            //e.preventDefault();
            axios.post('/api/depot/ajoutDepot', datas);
            console.log(datas);
                /*.then(response => {
                    let data = new Array();
                    data.push(datas)
                })
                .catch(error => {
                    null //une erreur s'est produite
                })*/
        }
    }

    isAgree() {
        let mailValue = gid("email").value;
        if(window.confirm("Souhaitez vous réellement envoyer ce fichier à " + mailValue + " ?")) {
            gid("error-p").innerText = "";
            let titreValue = gid("titre").value;
            let fileValue = gid("file").value;
            let descValue = gid("description").value;

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
            if(fileValue.length < 1) {
                gid("error-p").innerText = "Il manque le fichier !";
                return "Il manque le fichier !";
            }
            if(descValue.length > 255) {
                gid("error-p").innerText = "La description fait plus de 255 caractères !";
                return "La description fait plus de 255 caractères !";
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
            return true;
        }
    }

    render() {
        return (
            <div className="depot-cadre">
                <div class="mb-3">
                    <label className="form-label">Adresse mail</label>
                    <input id="email" type="email" className="form-control" placeholder="eleve@adresse.com" value="eleve@gmail.com"></input>
                </div>
                <div class="mb-3">
                    <label className="form-label">Titre du dépôt</label>
                    <input id="titre" type="text" className="form-control" value="Test"></input>
                </div>
                <div class="mb-3">
                    <label className="form-label">Description (max. 255 caractères)</label>
                    <textarea id="description" className="form-control" rows="3">Test de description</textarea>
                </div>
                <div class="form-group">
                    <label className="form-label">Choisissez votre fichier à envoyer</label>
                    <input id="file" enctype="multipart/form-data" type="file" class="form-control-file" onChange={this.onFileChange}></input>
                </div>
                <button className="btn btn-primary" type="submit" onClick={this.submitHandler}>Envoyer la ressource</button>
                <p id="error-p" className="text-danger" style={{marginTop: "20px"}}>
                </p>
            </div>
        )
    }
}

export default DepotProf;