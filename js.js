/**
 * FACULDADE ANHANGUERA DE BAURU
 * CIÊNCIAS DA COMPUTAÇÃO
 * 
 * INTELIGÊNCIA ARTIFICIAL
 * ALGORITIMO ARAD/BUCHAREST
 * 
 * CRIADO POR:  MATHEUS MERNICK
 * EMAIL:       mernick@live.com
 * DATA:        03/10/2015
 */

//------------------------------------------------------------------------------
function carrega_cidades(){
    function retorno(ret){
        id('lista_cidades').innerHTML = ret;
        carrega_cmb_cidades();
    };
    ajax('php/carregar_cidades.php', null, retorno);
};

//------------------------------------------------------------------------------
function carrega_cmb_cidades(){
    function retorno(ret){
        id('cidade_atual').innerHTML            = ret;
        id('cidade_destino').innerHTML          = ret;
        
        id('cidade_atual_param').innerHTML            = ret;
        id('cidade_destino_param').innerHTML          = ret;
    };
    ajax('php/carregar_cmb_cidades.php', null, retorno);
};

//------------------------------------------------------------------------------
function carrega_cidades_vinculadas(){
    function retorno(ret){
        id('cidades_vinculadas').innerHTML = ret;
    };
    ajax('php/carregar_cidades_vinculadas.php', null, retorno);
};

//------------------------------------------------------------------------------
function edita_km(o){
   function retorno(ret){
    };
    
    var strpar = array_args('cidade', o.parentNode.getAttribute('cidade'), 'destino', o.parentNode.getAttribute('destino'), 'km', o.innerText);
    ajax('php/editar_vinculo.php', strpar, retorno);
};

//------------------------------------------------------------------------------
function calcular_rotas(){
    function retorno(ret){
        id('resultados').innerHTML = ret;
        
        var arr_total = [], total, total_min, result;
        result = document.querySelectorAll(".total");
        
        for(var i = 0; i < result.length; i++){
            total = parseInt(result[i].lastElementChild.innerText);
            arr_total.push(total);
        }
        
        total_min = Math.min.apply(Math, arr_total);
        
        for(var j = 0; j < result.length; j++){
            if(parseInt(result[j].lastElementChild.innerText) == total_min){
                result[j].style.color = "green";
            }
        }
    };
    
    if(!id('cidade_atual_param').value){
        alert('Selecione o Ponto de Partida!');
        return;
    }
    if(!id('cidade_destino_param').value){
        alert('Selecione o Destino!');
        return;
    }
    
    var strpar = array_args('cidade_atual', id('cidade_atual_param').value, 'cidade_destino', id('cidade_destino_param').value);
    ajax('php/calcular_rotas.php', strpar, retorno);
};

//------------------------------------------------------------------------------
function cadastra_cidades(){
    function retorno(ret){
        ret = JSON.parse(ret);
        if(ret.ERRO == 1){
            alert('Erro ao Criar/Gravar no Arquivo o nome da Cidade!!');
        }
        if(ret.ERRO == 2){
            alert('Cidade Já Existente!!');
        }
        id('nome_cidade').value = '';
        carrega_cidades();
    };
    
    if(!id('nome_cidade').value){
        alert('Preencha o Nome da Cidade!');
        return;
    }
        
    var strpar = array_args('nome_cidade', id('nome_cidade').value);
    ajax('php/salvar_cidades.php', strpar, retorno);
};

//------------------------------------------------------------------------------
function vincular_cidades(){
    function retorno(ret){
        carrega_cidades_vinculadas();
        
        id('cidade_atual').value    = '';
        id('cidade_destino').value  = '';
        id('cidade_km').value       = '';
    };
    
    if(!id('cidade_atual').value){
        alert('Selecione a Cidade Atual');
        return;
    }
    if(!id('cidade_destino').value){
        alert('Selecione a Cidade Destino');
        return;
    }
    if(!id('cidade_km').value){
        alert('Preencha a Distância');
        return;
    }
    
    var strpar = array_args('cidade_atual', id('cidade_atual').value, 'cidade_destino', id('cidade_destino').value, 'cidade_km', id('cidade_km').value);
    ajax('php/vincular_cidades.php', strpar, retorno);
};

carrega_cidades();
carrega_cmb_cidades();
carrega_cidades_vinculadas();