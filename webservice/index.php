<?php

header('Content-Type: application/json');

$db = mysqli_connect("localhost", "pedro728_home", "root", "pedro728_home");

function getCampo($nome_campo, $db) {
    $query = "SELECT * FROM campos WHERE campo = '$nome_campo'" or die("Erro na consulta campo." . mysqli_error($db));
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_array($result);
    } else {
        return array("conteudo" => null);
    }
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "GET":
        if (isset($_GET['page'])) {
            switch ($_GET['page']) {
                case "sobre":
                    $row = getCampo('descricao_pagina_sobre', $db);
                    $json_return = array("descricao" => utf8_encode($row['conteudo']));
                    break;
                case "portfolio":
                    if (isset($_GET['id'])) {
                        $idSearch = $_GET['id'];

                        $query_item = "SELECT * FROM item_portfolio WHERE id = '$idSearch';" or die("Erro na consulta item_portfolio." . mysqli_error($db));
                        $result_item = mysqli_query($db, $query_item);
                        $row_item = mysqli_fetch_array($result_item);

                        $id_item = $row_item["id"];

                        $query_img_item = "SELECT * FROM img_portolio WHERE id_item_portfolio = '$id_item';" or die("Erro na consulta img_portolio." . mysqli_error($db));
                        $result_img_item = mysqli_query($db, $query_img_item);
                        $json_imgs = array();
                        while ($row_img_item = mysqli_fetch_array($result_img_item)) {
                            array_push($json_imgs, $row_img_item["img"]);
                        }

                        $query_tecnologia_item = "SELECT * FROM tecnologia_portfolio WHERE id_item_portfolio = '$id_item';" or die("Erro na consulta tecnologia_portfolio." . mysqli_error($db));
                        $result_tecnologia_item = mysqli_query($db, $query_tecnologia_item);
                        $json_tecnologias = array();
                        while ($row_tecnologia_item = mysqli_fetch_array($result_tecnologia_item)) {
                            array_push($json_tecnologias, utf8_encode($row_tecnologia_item["tecnologia"]));
                        }

                        $json_return = array("id" => $id_item, "titulo" => utf8_encode($row_item["titulo"]), "descricao" => utf8_encode($row_item["descricao"]), "categoria" => utf8_encode($row_item["categoria"]), "img" => $json_imgs, "tecnologias" => $json_tecnologias);
                    } else {
                        $row = getCampo('descricao_pagina_portfolio', $db);
                        $json_return = array("descricao" => utf8_encode($row['conteudo']));
                    }
                    break;
                case "contato":
                    $row_telefone = getCampo('telefone_pagina_contato', $db);
                    $row_email = getCampo('email_pagina_contato', $db);
                    $row_linkedin = getCampo('linkedin_pagina_contato', $db);
                    $row_skype = getCampo('skype_pagina_contato', $db);

                    $json_return = array("telefone" => $row_telefone['conteudo'], "email" => $row_email['conteudo'], "linkedin" => $row_linkedin['conteudo'], "skype" => $row_skype['conteudo']);
                    break;
                default:
                    $json_return = NULL;
                    break;
            }
        } else {
            $query_item = "SELECT * FROM item_portfolio ORDER BY data;" or die("Erro na consulta item_portfolio." . mysqli_error($db));
            $result_item = mysqli_query($db, $query_item);
            $json_itens = array();
            while ($row_item = mysqli_fetch_array($result_item)) {
                $id_item = $row_item["id"];

                $query_img_item = "SELECT * FROM img_portolio WHERE id_item_portfolio = '$id_item';" or die("Erro na consulta img_portolio." . mysqli_error($db));
                $result_img_item = mysqli_query($db, $query_img_item);
                $json_imgs = array();
                while ($row_img_item = mysqli_fetch_array($result_img_item)) {
                    array_push($json_imgs, $row_img_item["img"]);
                }

                $query_tecnologia_item = "SELECT * FROM tecnologia_portfolio WHERE id_item_portfolio = '$id_item';" or die("Erro na consulta tecnologia_portfolio." . mysqli_error($db));
                $result_tecnologia_item = mysqli_query($db, $query_tecnologia_item);
                $json_tecnologias = array();
                while ($row_tecnologia_item = mysqli_fetch_array($result_tecnologia_item)) {
                    array_push($json_tecnologias, utf8_encode($row_tecnologia_item["tecnologia"]));
                }

                $json_item = array("id" => $id_item, "titulo" => utf8_encode($row_item["titulo"]), "categoria" => utf8_encode($row_item["categoria"]), "img" => $json_imgs, "tecnologias" => $json_tecnologias);
                array_push($json_itens, $json_item);
                $json_return = $json_itens;
            }
        }
        echo json_encode($json_return);
        break;
    case "POST":
        switch ($_GET['page']) {
            case "sobre":
                break;
            case "portfolio":
                break;
            case "contato":
                $json = "OK";
                break;
            default:
                $json_return = NULL;
                break;
        }
        /*
          $decode = json_decode(file_get_contents('php://input'), true);

          $produto = utf8_decode($decode['produto']);
          $quantidade = $decode['quantidade'];

          $query = "INSERT INTO compras (id, nome, quantidade, comprado) VALUES (NULL, '$produto', '$quantidade', '0');" or die("Erro ao inserir." . mysqli_error($db));

          $result = mysqli_query($db, $query);

          $json = array();
          $json_1 = array("id" => mysqli_insert_id($db));
          array_push($json, $json_1);
         */
        echo json_encode($json);
        break;
    case "PUT":

        break;
    case "DELETE":
        $id = $_GET['id'];

        $query = "DELETE FROM compras WHERE compras.id = '$id'" or die("Erro ao deletar." . mysqli_error($db));

        $result = mysqli_query($db, $query);
        break;
    default:
        break;
}

