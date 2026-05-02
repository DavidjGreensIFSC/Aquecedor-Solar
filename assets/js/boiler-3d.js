const canvas = document.getElementById("boilerCanvas");

// ======================
// CENA
// ======================
const scene = new THREE.Scene();
scene.background = new THREE.Color(0xf8f8f8);

// ======================
// CAMERA
// ======================
const camera = new THREE.PerspectiveCamera(40, canvas.clientWidth / canvas.clientHeight, 0.1, 1000);
camera.position.set(6, 6, 14); // Afastei um pouco a câmera para ver tudo
camera.lookAt(0, 2, 0);

// ======================
// RENDER
// ======================
const renderer = new THREE.WebGLRenderer({ canvas, antialias: true });
renderer.setSize(canvas.clientWidth, canvas.clientHeight);
renderer.shadowMap.enabled = true;
// Deixa a sombra um pouco mais suave/realista
renderer.shadowMap.type = THREE.PCFSoftShadowMap; 

// ======================
// LUZ (SOMBRAS AJUSTADAS)
// ======================
const light = new THREE.DirectionalLight(0xffffff, 1.2);
light.position.set(10, 15, 10);
light.castShadow = true;

// Aumentando a qualidade e a área da sombra
light.shadow.mapSize.width = 1024;
light.shadow.mapSize.height = 1024;
light.shadow.camera.near = 0.5;
light.shadow.camera.far = 50;
light.shadow.camera.left = -10;
light.shadow.camera.right = 10;
light.shadow.camera.top = 10;
light.shadow.camera.bottom = -10;

scene.add(light);
scene.add(new THREE.AmbientLight(0xffffff, 0.6));

// ======================
// GRUPO
// ======================
const group = new THREE.Group();
scene.add(group);

// ======================
// BASE
// ======================
const base = new THREE.Mesh(
  new THREE.BoxGeometry(6.5, 0.3, 1),
  new THREE.MeshStandardMaterial({ color: 0x888888 })
);
base.position.set(0, 0, 0);
base.castShadow = true;     // Ativando sombra
base.receiveShadow = true;  // Ativando sombra
group.add(base);

// ======================
// CONFIG
// ======================
const TOTAL = 15;
const spacing = 0.25;
const tubeLength = 6;
const angle = Math.PI / 3.5;

// ======================
// TUBOS
// ======================
const tubesGroup = new THREE.Group();
group.add(tubesGroup);

let topY = 0;
let topZ = 0;

for (let i = 0; i < TOTAL; i++) {
  const geo = new THREE.CylinderGeometry(0.07, 0.07, tubeLength, 20);
  geo.translate(0, tubeLength / 2, 0);

  const tube = new THREE.Mesh(
    geo,
    new THREE.MeshStandardMaterial({
      color: 0x0b1f3a,
      metalness: 1,
      roughness: 0.1
    })
  );

  const offset = (TOTAL - 1) / 2;
  const x = (i - offset) * spacing;

  tube.position.set(x, 0.15, 0.5);
  tube.rotation.x = -angle;
  tube.castShadow = true;    // Ativando sombra
  tube.receiveShadow = true; // Ativando sombra

  tubesGroup.add(tube);

  if (i === 0) {
    topY = tube.position.y + Math.cos(angle) * tubeLength;
    topZ = tube.position.z - Math.sin(angle) * tubeLength;
  }
}

// ======================
// BOILER
// ======================
const tankRadius = 1.05;
const tankLength = 6;

const tank = new THREE.Mesh(
  new THREE.CylinderGeometry(tankRadius, tankRadius, tankLength, 64),
  new THREE.MeshStandardMaterial({
    color: 0xf0f0f0,
    metalness: 0.9,
    roughness: 0.25
  })
);

tank.rotation.z = Math.PI / 2;
tank.position.set(0, topY + tankRadius * 0.5, topZ - tankRadius * 0.5); 
tank.castShadow = true;    // Ativando sombra
tank.receiveShadow = true; // Ativando sombra
group.add(tank);

// Tampas do Boiler
const capMat = new THREE.MeshStandardMaterial({ color: 0x555555 });

const capL = new THREE.Mesh(
  new THREE.CylinderGeometry(tankRadius + 0.02, tankRadius + 0.02, 0.25, 64),
  capMat
);
capL.rotation.z = Math.PI / 2;
capL.position.set(-tankLength / 2, tank.position.y, tank.position.z);
capL.castShadow = true;
capL.receiveShadow = true;

const capR = capL.clone();
capR.position.x = tankLength / 2;

group.add(capL, capR);

// ======================
// ESTRUTURA DE SUPORTE
// ======================
function createSupport(x) {
  const mat = new THREE.MeshStandardMaterial({ color: 0x666666 });
  const g = new THREE.Group();

  const backZ = tank.position.z;
  const frontZ = 0.5;
  const height = tank.position.y - tankRadius;

  const footLen = Math.abs(frontZ - backZ) + 1; 
  const footZ = (frontZ + backZ) / 2;
  const foot = new THREE.Mesh(new THREE.BoxGeometry(0.2, 0.2, footLen), mat);
  foot.position.set(x, 0.1, footZ);
  foot.castShadow = true; foot.receiveShadow = true;
  g.add(foot);

  const backCol = new THREE.Mesh(new THREE.BoxGeometry(0.2, height, 0.2), mat);
  backCol.position.set(x, height / 2, backZ);
  backCol.castShadow = true; backCol.receiveShadow = true;
  g.add(backCol);

  const dZ = frontZ - backZ;
  const diagLen = Math.sqrt(dZ * dZ + height * height);
  const diag = new THREE.Mesh(new THREE.BoxGeometry(0.2, diagLen, 0.2), mat);
  diag.position.set(x, height / 2, footZ);
  diag.rotation.x = Math.atan2(dZ, height);
  diag.castShadow = true; diag.receiveShadow = true;
  g.add(diag);

  const cradle = new THREE.Mesh(new THREE.BoxGeometry(0.4, 0.2, tankRadius * 1.5), mat);
  cradle.position.set(x, height, backZ);
  cradle.castShadow = true; cradle.receiveShadow = true;
  g.add(cradle);

  return g;
}

group.add(createSupport(-2.5));
group.add(createSupport(2.5));

// ======================
// CANOS LATERAIS (CORES INVERTIDAS)
// ======================

// Quente (Agora Vermelho na Esquerda)
const hot = new THREE.Mesh(
  new THREE.CylinderGeometry(0.05, 0.05, 0.6, 20),
  new THREE.MeshStandardMaterial({ color: 0xff5722 }) // Vermelho/Laranja
);
hot.rotation.z = Math.PI / 2;
hot.position.set(-3.2, tank.position.y - 0.5, tank.position.z);
hot.castShadow = true;
hot.receiveShadow = true;
group.add(hot);

// Frio (Agora Azul na Direita)
const cold = new THREE.Mesh(
  new THREE.CylinderGeometry(0.05, 0.05, 0.6, 20),
  new THREE.MeshStandardMaterial({ color: 0x4fc3f7 }) // Azul
);
cold.rotation.z = Math.PI / 2;
cold.position.set(3.2, tank.position.y + 0.5, tank.position.z);
cold.castShadow = true;
cold.receiveShadow = true;
group.add(cold);

// ======================
// CONTROLE E INTERFACE 
// ======================
let dragging = false;
let prevX = 0;
const anguloDisplay = document.getElementById("anguloAtual");

canvas.addEventListener("mousedown", (e) => {
  dragging = true;
  prevX = e.clientX;
});

canvas.addEventListener("mouseup", () => dragging = false);
canvas.addEventListener("mouseleave", () => dragging = false);

canvas.addEventListener("mousemove", (e) => {
  if (!dragging) return;
  const dx = e.clientX - prevX;
  prevX = e.clientX;
  
  group.rotation.y += dx * 0.01;

  if (anguloDisplay) {
    let graus = Math.round(group.rotation.y * (180 / Math.PI)) % 360;
    if (graus < 0) graus += 360;
    anguloDisplay.innerText = graus + "°";
  }
});

// ======================
// LOOP
// ======================
function animate() {
  requestAnimationFrame(animate);
  renderer.render(scene, camera);
}
animate();

// ======================
// RESPONSIVO
// ======================
window.addEventListener("resize", () => {
  const w = canvas.clientWidth;
  const h = canvas.clientHeight;
  renderer.setSize(w, h);
  camera.aspect = w / h;
  camera.updateProjectionMatrix();
});