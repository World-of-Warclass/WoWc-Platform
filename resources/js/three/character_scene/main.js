import * as THREE from "three";
import { scene } from "./basic/Scene.js";
import { CharacterCamera } from "./basic/Camera.js";
import { initRenderer } from "./basic/Renderer.js";
import { CharacterThreePointLighting } from "./basic/Light.js";
import { BasicCharacterController } from "./basic/models/Character.js";
import * as AMBIENCE from "./basic/models/Ambience.js";
import { ObjectControls } from "threejs-object-controls";

const fetchJSON = (url) =>
    fetch(url).then((res) => {
        if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
        return res.json();
    });

const init = async () => {
    try {
        const characterAmbienceData = await fetchJSON(
            "/character/ambience/1"
        );

        const [dataAmbience, timeData] = await Promise.all([
            fetchJSON("/three/character_scene/config/ambience.json"),
            fetchJSON("/three/character_scene/config/time.json"),
        ]);

        const sceneElement = document.getElementById("scene");

        const characterAmbience = characterAmbienceData.ambience || "Ambience1";

        const ambience = dataAmbience[characterAmbience];
        const { focusPosition, cameraPosition, lights: lightsData } = ambience;

        let time;
        if (timeData[characterAmbience.time]) {
            time = characterAmbience.time;
        } else if (ambience["time"] && timeData[ambience["time"]]) {
            time = ambience["time"];
        } else {
            console.error("Time configuration not found, using default.");
            time = "day";
        }

        const renderer = initRenderer(timeData[time]["exposure"]);
        const canvas = renderer.domElement;
        canvas.setAttribute("tabindex", "0");
        canvas.style.outline = "none";

        const cameraController = new CharacterCamera(renderer, cameraPosition);
        const camera = cameraController.camera;

        const controls = new BasicCharacterController({
            camera,
            scene,
            canvas,
            position: focusPosition,
        });

        const character = await controls.getCharacter();
        const characterSize = new THREE.Vector3();
        const box = new THREE.Box3();
        box.setFromObject(character).getSize(characterSize);

        if (character) {
            let control = new ObjectControls(
                camera,
                renderer.domElement,
                character
            );
            control.setRotationSpeed(0.075);
            control.disableZoom();
        }

        const targetPosition = {
            x: focusPosition.x,
            y: focusPosition.y + (5 * characterSize.y) / 9,
            z: focusPosition.z,
        };

        camera.lookAt(targetPosition.x, targetPosition.y, targetPosition.z);

        const lights = new CharacterThreePointLighting(
            lightsData,
            timeData[time],
            targetPosition,
            characterSize
        );

        lights.add(scene);

        await loadAmbience(characterAmbience, scene, character);

        startRendering(renderer, scene, camera, controls);

        sceneElement.style.background = timeData[time]["skyColor"];
        sceneElement.appendChild(renderer.domElement);

        setTimeout(() => {
            document.getElementById("loading").classList.add("opacity-0");
        }, 100);

        setTimeout(() => {
            document.getElementById("loading").classList.remove();
            document.getElementById("loading").classList.add("hidden");
        }, 600);
    } catch (error) {
        console.error("ERROR:", error);
    }
};

const loadAmbience = async (ambience, scene, character) => {
    const ambiences = {
        Ambience1: () => {
            character.rotation.set(0, (3 / 4) * Math.PI, 0);
            return AMBIENCE.createAmbience1(scene);
        },
        Ambience2: () => {
            character.rotation.set(0, (1 / 2) * Math.PI, 0);
            return AMBIENCE.createAmbience2(scene);
        },
        Ambience3: () => {
            character.rotation.set(0, (1 / 4) * Math.PI - 0.25, 0);
            return AMBIENCE.createAmbience3(scene);
        },
        Ambience4: () => {
            character.rotation.set(0, Math.PI, 0);
            return AMBIENCE.createAmbience4(scene);
        },
        Ambience5: () => {
            character.rotation.set(0, (7 / 4) * Math.PI - 0.17, 0);
            return AMBIENCE.createAmbience5(scene);
        },
    };

    return ambiences[ambience]();
};

const startRendering = (renderer, scene, camera, controls) => {
    let previousRAF = null;

    const resizeCanvas = () => {
        const container = renderer.domElement.parentNode;

        if (container) {
            const width = container.offsetWidth;
            const height = container.offsetHeight;

            renderer.setSize(width, height);

            camera.aspect = width / height;
            camera.updateProjectionMatrix();
        }
    };

    function RAF() {
        requestAnimationFrame((t) => {
            if (previousRAF === null) {
                previousRAF = t;
            }

            RAF();

            renderer.render(scene, camera);

            resizeCanvas();

            step(t - previousRAF);
            previousRAF = t;
        });
    }

    function step(timeElapsed) {
        const timeElapsedS = timeElapsed * 0.001;
        controls?.Update(timeElapsedS);
    }

    RAF();
};

window.addEventListener("load", () => {
    setTimeout(init, 500);

    fetch("/character/appearance/1")
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            console.log(data);
            const appearanceData = JSON.parse(data.appearance);
            console.log(appearanceData);

            console.log("Hair:", appearanceData.Appearance.Hair);
            console.log("Eyes:", appearanceData.Appearance.Eyes);
            console.log("Skin:", appearanceData.Appearance.Skin);
            console.log("Shirt:", appearanceData.Appearance.Shirt);
            console.log("Pants:", appearanceData.Appearance.Pants);
            console.log("Shoes:", appearanceData.Appearance.Shoes);
        })
        .catch((error) => {
            console.error(
                "There has been a problem with your fetch operation:",
                error
            );
        });
});
