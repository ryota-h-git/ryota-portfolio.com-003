jQuery(function ($) {
  $("#js-button-drawer").on("click", function () {
    $(this).toggleClass("is-checked");
    $("#js-drawer").toggleClass("is-checked");
  });
});

document.querySelectorAll(".l-header__nav-link").forEach((link) => {
  link.addEventListener("click", function () {
    document.querySelector(".l-header-drawer").classList.remove("is-checked");
    document
      .querySelector(".l-header__menu-button")
      .classList.remove("is-checked");
  });
});

const intersectionObserver = new IntersectionObserver(function (entries) {
  entries.forEach(function (entry) {
    if (entry.isIntersecting) {
      entry.target.classList.add("is-in-view");
    } else {
      entry.target.classList.remove("is-in-view");
    }
  });
});

const inViewItems = document.querySelectorAll(".js-in-view");
inViewItems.forEach(function (inViewItem) {
  intersectionObserver.observe(inViewItem);
});

jQuery('a[href^="#"]').on("click", function (e) {
  e.preventDefault(); // ページ内リンクのデフォルト動作を無効化

  const id = jQuery(this).attr("href");
  const target = jQuery("#" === id ? "html" : id);
  const position = target.offset().top;

  // スムーススクロール
  jQuery("html, body").animate(
    {
      scrollTop: position,
    },
    1000,
    "swing"
  );
});


function getResponsiveRadius() {
  const width = window.innerWidth;
  if (width <= 480) return 30; // スマホ
  if (width <= 768) return 40; // タブレット
  return 50; // PC
}

const slideUpText1 = document.querySelectorAll(".p-fv__subtitle");
new SplitType(slideUpText1);




const WorkSwiper = new Swiper(".p-work__swiper", {
  speed: 10000, 
  effect: "slide",
  allowTouchMove: true,
  loop: true,
  autoplay: {
    delay: 0,
    stopOnLastSlide: false, 
    disableOnInteraction: false, 
    reverseDirection: false, 
  },

  centeredSlides: true, 
  slidesPerView: "auto",
  spaceBetween: 0,
});

document.addEventListener("DOMContentLoaded", () => {
  document.fonts.ready.then(() => {
    const target = document.querySelector(".is-target");
    if (target) {
      target.classList.add("is-font-loaded");
    }
  });
});

// 鯨のドット生成
gsap.registerPlugin(MotionPathPlugin);

window.addEventListener("load", () => {
  const whalePaths = document.querySelectorAll(".p-fv__whale svg .line--main");
  const dotsContainer = document.querySelector(".p-fv__dots");
  const svg = document.querySelector(".p-fv__whale svg");

  if (!whalePaths.length || !svg || !dotsContainer) return;

  // グラデーション定義を追加（光るエフェクト用）
  const defs = svg.querySelector("defs") || document.createElementNS("http://www.w3.org/2000/svg", "defs");
  if (!svg.querySelector("defs")) {
    svg.insertBefore(defs, svg.firstChild);
  }

  // グラデーションIDが存在しない場合のみ作成
  if (!defs.querySelector("#lineGradient")) {
    const gradient = document.createElementNS("http://www.w3.org/2000/svg", "linearGradient");
    gradient.setAttribute("id", "lineGradient");
    gradient.setAttribute("x1", "0%");
    gradient.setAttribute("y1", "0%");
    gradient.setAttribute("x2", "100%");
    gradient.setAttribute("y2", "0%");
    
    // グラデーションストップを追加
    const stop1 = document.createElementNS("http://www.w3.org/2000/svg", "stop");
    stop1.setAttribute("offset", "0%");
    stop1.setAttribute("stop-color", "#98a4ea");
    stop1.setAttribute("stop-opacity", "0.3");
    
    const stop2 = document.createElementNS("http://www.w3.org/2000/svg", "stop");
    stop2.setAttribute("offset", "50%");
    stop2.setAttribute("stop-color", "#ffffff");
    stop2.setAttribute("stop-opacity", "1");
    
    const stop3 = document.createElementNS("http://www.w3.org/2000/svg", "stop");
    stop3.setAttribute("offset", "100%");
    stop3.setAttribute("stop-color", "#98a4ea");
    stop3.setAttribute("stop-opacity", "0.3");
    
    gradient.appendChild(stop1);
    gradient.appendChild(stop2);
    gradient.appendChild(stop3);
    defs.appendChild(gradient);
  }

  const dotsRect = dotsContainer.getBoundingClientRect();
  const matrix = svg.getScreenCTM();

  // 接続点を格納するSet（重複を防ぐ）
  const connectionPoints = new Set();
  const positions = [];

  // 接続点を取得する関数
  const getConnectionPoint = (point) => {
    // 小数点以下を丸めて、近い点を同じ点として扱う（重複除去）
    const roundedX = Math.round(point.x * 10) / 10;
    const roundedY = Math.round(point.y * 10) / 10;
    return `${roundedX},${roundedY}`;
  };

  // SVG座標を画面座標に変換する関数
  const svgToScreen = (svgPoint) => {
    const point = svg.createSVGPoint();
    point.x = svgPoint.x;
    point.y = svgPoint.y;
    const screenPoint = point.matrixTransform(matrix);
    return {
      x: screenPoint.x - dotsRect.left,
      y: screenPoint.y - dotsRect.top
    };
  };

  // 1. まず全ての接続点（始点・終点）を収集
  whalePaths.forEach((path) => {
    try {
      const len = path.getTotalLength();
      if (len === 0) return;

      // 始点
      const startPoint = path.getPointAtLength(0);
      const startKey = getConnectionPoint(startPoint);
      if (!connectionPoints.has(startKey)) {
        connectionPoints.add(startKey);
        positions.push({
          x: svgToScreen(startPoint).x,
          y: svgToScreen(startPoint).y,
          isConnection: true // 接続点フラグ
        });
      }

      // 終点
      const endPoint = path.getPointAtLength(len);
      const endKey = getConnectionPoint(endPoint);
      if (!connectionPoints.has(endKey)) {
        connectionPoints.add(endKey);
        positions.push({
          x: svgToScreen(endPoint).x,
          y: svgToScreen(endPoint).y,
          isConnection: true
        });
      }
    } catch (e) {
      // エラー処理
    }
  });

  // 2. 線の途中にも均等にドットを配置（接続点以外）
  whalePaths.forEach((path) => {
    try {
      const len = path.getTotalLength();
      if (len === 0) return;

      const step = Math.max(50, len / 60); // ドットの間隔を調整
      
      // 始点と終点を除いて、途中の点を取得
      for (let i = step; i < len - step; i += step) {
        const point = path.getPointAtLength(i);
        const pointKey = getConnectionPoint(point);
        
        // 接続点でない場合のみ追加
        if (!connectionPoints.has(pointKey)) {
          const screenPoint = svgToScreen(point);
          positions.push({
            x: screenPoint.x,
            y: screenPoint.y,
            isConnection: false
          });
        }
      }
    } catch (e) {
      // エラー処理
    }
  });

  // 🟠 ドットの生成とアニメーション
  const totalDots = positions.length;
  const vw = dotsRect.width;
  const vh = dotsRect.height;

  for (let i = 0; i < totalDots; i++) {
    const dot = document.createElement("div");
    dot.classList.add("dot");
    dotsContainer.appendChild(dot);

    const startX = Math.random() * vw;
    const startY = Math.random() * vh;
    const { x: targetX, y: targetY } = positions[i];

    gsap.set(dot, {
      x: startX,
      y: startY,
      width: 4,
      height: 4,
      background: "#0077cc",
      borderRadius: "50%",
      opacity: 0.4,
      position: "absolute",
    });

    gsap.to(dot, {
      duration: 7,
      delay: Math.random() * 0.8,
      ease: "power2.out",
      x: targetX,
      y: targetY,
      opacity: 1,
    });
  }

  const MIN_DIST = 6;
const isNear = (a, b) => {
  const dx = a.x - b.x;
  const dy = a.y - b.y;
  return dx * dx + dy * dy < MIN_DIST * MIN_DIST;
};

const pushUnique = (p) => {
  if (positions.some((q) => isNear(p, q))) return;
  positions.push(p);
};


  // 線を描くアニメーション
  whalePaths.forEach((path, index) => {
    const len = path.getTotalLength();
    gsap.set(path, { strokeDasharray: len, strokeDashoffset: len });
    gsap.to(path, {
      strokeDashoffset: 0,
      duration: 2.5,
      delay: 1.5 + index * 0.05,
      ease: "power2.out",
    });
  });
});

// 背景の泡

const bg = document.querySelector(".p-fv");
for (let i = 0; i < 30; i++) {
  const bubble = document.createElement("div");
  bubble.classList.add("bubble");
  bg.appendChild(bubble);

  gsap.set(bubble, {
    x: Math.random() * window.innerWidth,
    y: window.innerHeight + Math.random() * 100,
    scale: Math.random() * 0.4 + 0.3,
  });

  gsap.to(bubble, {
    duration: 10 + Math.random() * 5,
    y: -100,
    repeat: -1,
    delay: Math.random() * 5,
    ease: "sine.inOut",
  });
}

