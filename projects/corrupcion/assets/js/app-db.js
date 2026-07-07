let casos = [];

const tableBody = document.getElementById("casesTableBody");

const filters = {
  partido: document.getElementById("filterPartido"),
  fase: document.getElementById("filterFase"),
  tribunal: document.getElementById("filterTribunal"),
  gravedad: document.getElementById("filterGravedad"),
  estado: document.getElementById("filterEstado"),
  search: document.getElementById("searchText")
};

function normalize(text) {
  return String(text || "")
    .toLowerCase()
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "");
}

// Determina la clase de etiqueta de fase para el estilo visual.
function getFaseClass(fase) {
  const value = normalize(fase);

  if (value.includes("instruccion")) return "fase-instruccion";
  if (value.includes("procesamiento") || value.includes("abreviado")) return "fase-procesamiento";
  if (value.includes("juicio")) return "fase-juicio";
  if (value.includes("sentencia")) return "fase-sentencia";
  if (value.includes("recurso")) return "fase-recurso";
  if (value.includes("ejecucion")) return "fase-ejecucion";
  if (value.includes("archivado") || value.includes("excluido")) return "fase-archivado";

  return "fase-archivado";
}

function getGravedadClass(gravedad) {
  const value = normalize(gravedad);

  if (value.includes("alta")) return "grave-alta";
  if (value.includes("media")) return "grave-media";
  if (value.includes("baja")) return "grave-baja";
  if (value.includes("dudosa")) return "grave-dudosa";

  return "grave-dudosa";
}

// Aplica estilos de estado para diferenciar visualmente el seguimiento.
function getEstadoClass(estado) {
  const value = normalize(estado);

  if (value.includes("activo")) return "status-activo";
  if (value.includes("dudoso")) return "status-dudoso";
  if (value.includes("excluido") || value.includes("archivado")) return "status-excluido";

  return "";
}

function createOption(value) {
  const option = document.createElement("option");
  option.value = value;
  option.textContent = value;
  return option;
}

function fillSelect(selectElement, values) {
  const uniqueValues = [...new Set(values.filter(Boolean))].sort();

  uniqueValues.forEach(value => {
    selectElement.appendChild(createOption(value));
  });
}

function fillFilters() {
  fillSelect(filters.partido, casos.map(caso => caso.partido));
  fillSelect(filters.fase, casos.map(caso => caso.fase));
  fillSelect(filters.tribunal, casos.map(caso => caso.tribunal));
  fillSelect(filters.gravedad, casos.map(caso => caso.gravedad));
  fillSelect(filters.estado, casos.map(caso => caso.estado));
}

function renderTable(data) {
  tableBody.innerHTML = "";

  if (data.length === 0) {
    tableBody.innerHTML = `
      <tr>
        <td colspan="10">
          No hay casos que coincidan con los filtros o la búsqueda.
        </td>
      </tr>
    `;
    return;
  }

  data.forEach(caso => {
    const row = document.createElement("tr");

    row.innerHTML = `
      <td data-label="Partido / entorno">${caso.partido}</td>
      <td data-label="Caso"><span class="case-title">${caso.caso}</span></td>
      <td data-label="Fase"><span class="tag ${getFaseClass(caso.fase)}">${caso.fase}</span></td>
      <td data-label="Tribunal / órgano">${caso.tribunal}</td>
      <td data-label="Personas / entidades">${caso.personas}</td>
      <td data-label="Gravedad"><span class="grave ${getGravedadClass(caso.gravedad)}">${caso.gravedad}</span></td>
      <td data-label="Tipo de vínculo">${caso.vinculo}</td>
      <td data-label="Estado"><span class="${getEstadoClass(caso.estado)}">${caso.estado}</span></td>
      <td data-label="Observaciones">${caso.observaciones}</td>
      <td data-label="Última revisión">${caso.ultimaRevision}</td>
    `;

    tableBody.appendChild(row);
  });
}

function applyFilters() {
  const partido = normalize(filters.partido.value);
  const fase = normalize(filters.fase.value);
  const tribunal = normalize(filters.tribunal.value);
  const gravedad = normalize(filters.gravedad.value);
  const estado = normalize(filters.estado.value);
  const search = normalize(filters.search.value);

  const filtered = casos.filter(caso => {
    const fullText = normalize(Object.values(caso).join(" "));

    return (
      (!partido || normalize(caso.partido) === partido) &&
      (!fase || normalize(caso.fase) === fase) &&
      (!tribunal || normalize(caso.tribunal) === tribunal) &&
      (!gravedad || normalize(caso.gravedad) === gravedad) &&
      (!estado || normalize(caso.estado) === estado) &&
      (!search || fullText.includes(search))
    );
  });

  renderTable(filtered);
}

async function loadData() {
  try {
    const response = await fetch("api/casos.php");

    if (!response.ok) {
      throw new Error("No se pudo cargar api/casos.php");
    }

    casos = await response.json();

    fillFilters();
    renderTable(casos);
  } catch (error) {
    tableBody.innerHTML = `
      <tr>
        <td colspan="10">
          Error cargando los datos. Revisa que exista el archivo api/casos.php
          y que Live Server esté funcionando.
        </td>
      </tr>
    `;

    console.error(error);
  }
}

Object.values(filters).forEach(control => {
  control.addEventListener("input", applyFilters);
  control.addEventListener("change", applyFilters);
});

loadData();
