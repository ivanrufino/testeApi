<h1> Teste api</h1>
<ul>
<li>Empresas
    <ul>
        <li>GET  api/empresas </li>
        <li>POST      api/empresas </li>
        <li>GET  api/empresas/{codigo} </li>
        <li>PUT       api/empresas/{codigo} </li>
        <li>DELETE    api/empresas/{codigo}</li>
    </ul>
    </li>
<li>Clientes
<ul>
        <li>GET  api/empresas/{codigoEmpresa}/clientes </li>
        <li>POST      api/empresas/{codigoEmpresa}/clientes </li>
        <li>GET  api/empresas/{codigoEmpresa}/clientes/{codigoCliente} </li>
        <li>PUT       api/empresas/{codigoEmpresa}/clientes/{codigoCliente} </li>
        <li>DELETE    api/empresas/{codigoEmpresa}/clientes/{codigoCliente} </li>
    </ul>
    </li>
</ul>

<p>
 <h2>GET  api/empresas </h2>
 <h3>response</h3>   
    <code>
Status: 200 OK
Content-Type: application/json

{
  "empresas": [
    {
      "codigo": 1,
      "empresa": 123,
      "sigla": "ABC",
      "razao_social": "Empresa ABC",
      "updated_at": "2023-11-23T00:00:00Z",
      "created_at": "2023-11-23T00:00:00Z"
    },
    // ... Outras empresas ...
  ]
}

</code>
</p>
<p>
<h2>POST  api/empresas </h2>
<h3>request</h3> 
<code>
{
  "codigo": 2,
  "empresa": 456,
  "sigla": "XYZ",
  "razao_social": "Empresa XYZ"
}

</code>
<h3>response</h3> 
<code>
Status: 201 Created
Content-Type: application/json

{
  "empresa": {
    "codigo": 2,
    "empresa": 456,
    "sigla": "XYZ",
    "razao_social": "Empresa XYZ",
    "updated_at": "2023-11-23T00:00:00Z",
    "created_at": "2023-11-23T00:00:00Z"
  }
}

</code>
</p>

<p>
<h2>GET  api/empresas/{codigo} </h2>
<h3>response</h3> 
<code>
Status: 200 OK
Content-Type: application/json

{
  "empresa": {
    "codigo": 1,
    "empresa": 123,
    "sigla": "ABC",
    "razao_social": "Empresa ABC",
    "updated_at": "2023-11-23T00:00:00Z",
    "created_at": "2023-11-23T00:00:00Z"
  }
}

</code>
</p>
<p>
<h2>PUT /api/empresas/{codigo}</h2>
<h3>request<h3>
<code>
{
  "empresa": 789,
  "sigla": "NEW",
  "razao_social": "Nova Empresa XYZ"
}

</code>
<h3>response<h3>
<code>
Status: 200 OK
Content-Type: application/json

{
  "empresa": {
    "codigo": 1,
    "empresa": 789,
    "sigla": "NEW",
    "razao_social": "Nova Empresa XYZ",
    "updated_at": "2023-11-24T00:00:00Z",
    "created_at": "2023-11-23T00:00:00Z"
  }
}

</code>
</p>
<h2>DELETE /api/empresas/{codigo}
<h3>response</h3>
<code>
Status: 202 Accepted
Content-Type: application/json

{
  "message": "Empresa excluída com sucesso!"
}

</code>
</h2>
<p></p>
<p></p>
<p></p>
<p></p>

