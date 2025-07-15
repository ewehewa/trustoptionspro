// Trading Chart Implementation
document.addEventListener("DOMContentLoaded", () => {
  const canvas = document.getElementById("tradingChart")
  if (canvas) {
    const ctx = canvas.getContext("2d")

    // Set canvas size
    function resizeCanvas() {
      const container = canvas.parentElement
      canvas.width = container.offsetWidth - 32
      canvas.height = container.offsetHeight - 32
      drawChart()
    }

    // Chart data points
    const chartData = [
      { x: 0, y: 150, volume: 20 },
      { x: 50, y: 120, volume: 35 },
      { x: 100, y: 140, volume: 25 },
      { x: 150, y: 80, volume: 45 },
      { x: 200, y: 100, volume: 30 },
      { x: 250, y: 60, volume: 55 },
      { x: 300, y: 90, volume: 40 },
      { x: 350, y: 40, volume: 60 },
      { x: 400, y: 70, volume: 35 },
    ]

    function drawChart() {
      const width = canvas.width
      const height = canvas.height

      // Clear canvas
      ctx.clearRect(0, 0, width, height)

      // Draw volume bars
      const volumeHeight = 60
      const barWidth = width / chartData.length

      chartData.forEach((point, index) => {
        const barHeight = (point.volume / 60) * volumeHeight
        const x = index * barWidth + barWidth / 4
        const y = height - barHeight

        // Alternate colors for volume bars
        ctx.fillStyle = index % 2 === 0 ? "#10b981" : "#ef4444"
        ctx.fillRect(x, y, barWidth / 2, barHeight)
      })

      // Draw price line
      ctx.beginPath()
      ctx.strokeStyle = "#3b82f6"
      ctx.lineWidth = 2

      chartData.forEach((point, index) => {
        const x = (point.x / 400) * width
        const y = ((200 - point.y) / 200) * (height - volumeHeight - 20) + 10

        if (index === 0) {
          ctx.moveTo(x, y)
        } else {
          ctx.lineTo(x, y)
        }
      })

      ctx.stroke()

      // Fill area under line
      ctx.beginPath()
      ctx.fillStyle = "rgba(59, 130, 246, 0.1)"

      chartData.forEach((point, index) => {
        const x = (point.x / 400) * width
        const y = ((200 - point.y) / 200) * (height - volumeHeight - 20) + 10

        if (index === 0) {
          ctx.moveTo(x, y)
        } else {
          ctx.lineTo(x, y)
        }
      })

      // Close the path to fill area
      const lastPoint = chartData[chartData.length - 1]
      const lastX = (lastPoint.x / 400) * width
      const firstX = (chartData[0].x / 400) * width

      ctx.lineTo(lastX, height - volumeHeight)
      ctx.lineTo(firstX, height - volumeHeight)
      ctx.closePath()
      ctx.fill()

      // Draw grid lines
      ctx.strokeStyle = "rgba(156, 163, 175, 0.2)"
      ctx.lineWidth = 1

      // Horizontal grid lines
      for (let i = 1; i < 5; i++) {
        const y = (i / 5) * (height - volumeHeight - 20) + 10
        ctx.beginPath()
        ctx.moveTo(0, y)
        ctx.lineTo(width, y)
        ctx.stroke()
      }

      // Vertical grid lines
      for (let i = 1; i < 8; i++) {
        const x = (i / 8) * width
        ctx.beginPath()
        ctx.moveTo(x, 10)
        ctx.lineTo(x, height - volumeHeight)
        ctx.stroke()
      }
    }

    // Initial draw
    resizeCanvas()

    // Redraw on window resize
    window.addEventListener("resize", resizeCanvas)

    // Simulate real-time updates
    setInterval(() => {
      // Update last data point
      const lastIndex = chartData.length - 1
      chartData[lastIndex].y += (Math.random() - 0.5) * 10

      // Keep within bounds
      if (chartData[lastIndex].y < 20) chartData[lastIndex].y = 20
      if (chartData[lastIndex].y > 180) chartData[lastIndex].y = 180

      drawChart()
    }, 2000)
  }

  // Initialize new sections
  const cryptoMarketData = [
    {
      symbol: "BTCUSDT",
      name: "Bitcoin / TetherUS",
      price: "109,759.81",
      changePercent: "+0.84%",
      changeValue: "+910.21",
      positive: true,
      icon: "₿",
      iconClass: "btc",
    },
    {
      symbol: "ETHUSDT",
      name: "Ethereum / TetherUS",
      price: "2,593.34",
      changePercent: "+0.89%",
      changeValue: "+22.93",
      positive: true,
      icon: "Ξ",
      iconClass: "eth",
    },
    {
      symbol: "USDT.D",
      name: "Market Cap USDT Dominance, %",
      price: "4.73",
      changePercent: "-0.58%",
      changeValue: "",
      positive: false,
      icon: "₮",
      iconClass: "usdt",
    },
  ]

  const defiMarketData = [
    {
      symbol: "DAI",
      name: "Market Cap DAI, $",
      price: "5.37 B",
      changePercent: "+0.04%",
      changeValue: "+1,985,191.00",
      positive: true,
      icon: "D",
      iconClass: "dai",
    },
    {
      symbol: "UNIUSD",
      name: "Uniswap / U.S. Dollar",
      price: "7.6064311",
      changePercent: "+3.50%",
      changeValue: "",
      positive: true,
      icon: "U",
      iconClass: "uni",
    },
    {
      symbol: "AVAXUSD",
      name: "AVAX / US Dollar",
      price: "18.5970810",
      changePercent: "+0.40%",
      changeValue: "",
      positive: true,
      icon: "A",
      iconClass: "avax",
    },
  ]

  // Function to render market data
  function renderMarketData(data, containerId) {
    const container = document.getElementById(containerId)
    if (!container) return

    container.innerHTML = ""

    data.forEach((item) => {
      const marketItem = document.createElement("div")
      marketItem.className = "market-item"

      marketItem.innerHTML = `
        <div class="market-left">
          <div class="market-icon ${item.iconClass}">
            ${item.icon}
          </div>
          <div class="market-info">
            <div class="market-symbol">${item.symbol}</div>
            <div class="market-name">${item.name}</div>
          </div>
        </div>
        <div class="market-right">
          <div class="market-price">${item.price}</div>
          <div class="market-change ${item.positive ? "positive" : "negative"}">
            <span class="change-percent">${item.changePercent}</span>
            ${item.changeValue ? `<span class="change-value">${item.changeValue}</span>` : ""}
          </div>
        </div>
      `

      container.appendChild(marketItem)
    })
  }

  renderMarketData(cryptoMarketData, "crypto-market-list")
  renderMarketData(defiMarketData, "defi-market-list")

  // Simulate real-time market data updates
  setInterval(() => {
    // Update crypto prices
    cryptoMarketData.forEach((item) => {
      const currentPrice = Number.parseFloat(item.price.replace(/,/g, ""))
      if (!isNaN(currentPrice)) {
        const change = (Math.random() - 0.5) * 0.02 // ±1% change
        const newPrice = currentPrice * (1 + change)
        item.price = newPrice.toLocaleString("en-US", {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2,
        })
      }
    })

    // Re-render market data
    renderMarketData(cryptoMarketData, "crypto-market-list")
    renderMarketData(defiMarketData, "defi-market-list")
  }, 5000)
})

// Mobile ticker animation for mobile view
function updateMobileTicker() {
  const tickerItems = document.querySelectorAll(".ticker-item")

  if (window.innerWidth <= 767) {
    // Mobile ticker data
    const mobileData = [
      { symbol: "AAPL", price: "223.41", change: "+3.49 (+1.59%)", positive: true },
      { symbol: "NVDA", price: "159.34", change: "+2.1", positive: true },
    ]

    let currentIndex = 0

    setInterval(() => {
      const data = mobileData[currentIndex]
      const tickerItem = tickerItems[0]

      if (tickerItem) {
        tickerItem.innerHTML = `
                    <span class="ticker-symbol">${data.symbol}</span>
                    <span class="ticker-separator">•</span>
                    <span class="ticker-price">${data.price}</span>
                    <sup class="ticker-sup">D</sup>
                    <span class="ticker-change ${data.positive ? "positive" : "negative"}">${data.change}</span>
                `
      }

      currentIndex = (currentIndex + 1) % mobileData.length
    }, 3000)
  }
}

// Initialize mobile ticker
document.addEventListener("DOMContentLoaded", updateMobileTicker)
window.addEventListener("resize", updateMobileTicker)

// Profile Dropdown Functionality
document.addEventListener("DOMContentLoaded", () => {
  const profileToggle = document.getElementById("profileToggle")
  const profileMenu = document.getElementById("profileMenu")
  const profileArrow = profileToggle?.querySelector(".profile-arrow")

  if (profileToggle && profileMenu) {
    profileToggle.addEventListener("click", (e) => {
      e.stopPropagation()
      const isOpen = profileMenu.classList.contains("show")

      if (isOpen) {
        profileMenu.classList.remove("show")
        profileToggle.classList.remove("active")
      } else {
        profileMenu.classList.add("show")
        profileToggle.classList.add("active")
      }
    })

    // Close dropdown when clicking outside
    document.addEventListener("click", (e) => {
      if (!profileToggle.contains(e.target) && !profileMenu.contains(e.target)) {
        profileMenu.classList.remove("show")
        profileToggle.classList.remove("active")
      }
    })

    // Handle profile menu item clicks
    const profileMenuItems = profileMenu.querySelectorAll(".profile-menu-item")
    profileMenuItems.forEach((item) => {
      item.addEventListener("click", () => {
        const text = item.querySelector("span").textContent
        console.log(`Clicked: ${text}`)

        if (text === "Logout") {
          // Handle logout logic here
          alert("Logout clicked!")
        } else if (text === "My Profile") {
          // Handle profile navigation here
          alert("My Profile clicked!")
        }

        // Close dropdown
        profileMenu.classList.remove("show")
        profileToggle.classList.remove("active")
      })
    })
  }

  // Sidebar Functionality
  const sidebarToggle = document.getElementById("sidebarToggle")
  const sidebar = document.getElementById("sidebar")
  const sidebarOverlay = document.getElementById("sidebarOverlay")
  const sidebarClose = document.getElementById("sidebarClose")

  function openSidebar() {
    sidebar.classList.add("show")
    sidebarOverlay.classList.add("show")
    document.body.style.overflow = "hidden"
  }

  function closeSidebar() {
    sidebar.classList.remove("show")
    sidebarOverlay.classList.remove("show")
    document.body.style.overflow = ""
  }

  // Sidebar toggle events
  if (sidebarToggle) {
    sidebarToggle.addEventListener("click", () => {
      if (sidebar.classList.contains("show")) {
        closeSidebar();
      } else {
        openSidebar();
      }
    });
  }

  if (sidebarClose) {
    sidebarClose.addEventListener("click", closeSidebar)
  }

  if (sidebarOverlay) {
    sidebarOverlay.addEventListener("click", closeSidebar)
  }

  // Handle sidebar navigation links
  const sidebarLinks = document.querySelectorAll(".sidebar-item")
  sidebarLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      const href = link.getAttribute("href")
      const text = link.querySelector("span").textContent

      // Handle special cases for logout and profile
      if (text === "Logout") {
        e.preventDefault()
        alert("Logout clicked!")
        return
      }

      // For regular navigation links, let the browser handle the navigation
      console.log(`Navigating to: ${href} (${text})`)

      // Remove active class from all items
      sidebarLinks.forEach((item) => item.classList.remove("active"))

      // Add active class to clicked item (only if staying on same page)
      if (href === window.location.pathname || href === window.location.pathname.split("/").pop()) {
        link.classList.add("active")
      }

      // Close sidebar after navigation on mobile
      if (window.innerWidth <= 768) {
        closeSidebar()
      }
    })
  })

  // Close sidebar on escape key
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && sidebar.classList.contains("show")) {
      closeSidebar()
    }
  })

  // Transaction tabs functionality (for dashboard)
  const transactionTabs = document.querySelectorAll(".tab-btn")
  const transactionTableHeader = document.getElementById("transaction-table-header")

  if (transactionTabs.length > 0 && transactionTableHeader) {
    // Set initial state
    updateTransactionTable("deposit")

    transactionTabs.forEach((tab) => {
      tab.addEventListener("click", function () {
        const tabType = this.dataset.tab

        // Remove active class from all tabs
        transactionTabs.forEach((t) => t.classList.remove("active"))

        // Add active class to clicked tab
        this.classList.add("active")

        // Update table headers
        updateTransactionTable(tabType)
      })
    })
  }

  function updateTransactionTable(type) {
    if (!transactionTableHeader) return

    if (type === "deposit") {
      transactionTableHeader.className = "table-header deposit-headers"
      transactionTableHeader.innerHTML = `
          <div class="table-col">Amount</div>
          <div class="table-col">Payment Mode</div>
          <div class="table-col">Status</div>
          <div class="table-col">Date Created</div>
      `
    } else {
      transactionTableHeader.className = "table-header withdrawal-headers"
      transactionTableHeader.innerHTML = `
          <div class="table-col">Amount Requested</div>
          <div class="table-col">Amount + Charges</div>
          <div class="table-col">Receiving Mode</div>
          <div class="table-col">Status</div>
          <div class="table-col">Date Created</div>
      `
    }
  }

  // Crypto market data (static)
  const cryptoData = [
    { symbol: "BTC", name: "Bitcoin", price: "$43,250.00", change: "+2.45%", changeValue: "+$1,035.50", icon: "btc" },
    { symbol: "ETH", name: "Ethereum", price: "$2,650.00", change: "+1.85%", changeValue: "+$48.25", icon: "eth" },
    { symbol: "USDT", name: "Tether", price: "$1.00", change: "+0.01%", changeValue: "+$0.0001", icon: "usdt" },
  ]

  // DeFi market data (static)
  const defiData = [
    { symbol: "DAI", name: "Dai", price: "$1.00", change: "+0.02%", changeValue: "+$0.0002", icon: "dai" },
    { symbol: "UNI", name: "Uniswap", price: "$8.45", change: "+3.25%", changeValue: "+$0.27", icon: "uni" },
    { symbol: "AVAX", name: "Avalanche", price: "$38.50", change: "+4.15%", changeValue: "+$1.53", icon: "avax" },
  ]

  // Populate market data
  populateMarketData("crypto-market-list", cryptoData)
  populateMarketData("defi-market-list", defiData)

  function populateMarketData(containerId, data) {
    const container = document.getElementById(containerId)
    if (!container) return

    container.innerHTML = data
      .map(
        (item) => `
        <div class="market-item">
            <div class="market-left">
                <div class="market-icon ${item.icon}">${item.symbol.charAt(0)}</div>
                <div class="market-info">
                    <div class="market-symbol">${item.symbol}</div>
                    <div class="market-name">${item.name}</div>
                </div>
            </div>
            <div class="market-right">
                <div class="market-price">${item.price}</div>
                <div class="market-change positive">
                    <span class="change-percent">${item.change}</span>
                    <span class="change-value">${item.changeValue}</span>
                </div>
            </div>
        </div>
    `,
      )
      .join("")
  }

  // Simple chart drawing for dashboard
  const canvasDashboard = document.getElementById("tradingChartDashboard")
  if (canvasDashboard) {
    const ctxDashboard = canvasDashboard.getContext("2d")

    // Set canvas size
    canvasDashboard.width = canvasDashboard.offsetWidth
    canvasDashboard.height = canvasDashboard.offsetHeight

    // Draw a simple line chart
    ctxDashboard.strokeStyle = "#3b82f6"
    ctxDashboard.lineWidth = 2
    ctxDashboard.beginPath()

    const pointsDashboard = [
      { x: 50, y: 200 },
      { x: 100, y: 180 },
      { x: 150, y: 160 },
      { x: 200, y: 140 },
      { x: 250, y: 120 },
      { x: 300, y: 100 },
      { x: 350, y: 80 },
    ]

    pointsDashboard.forEach((point, index) => {
      if (index === 0) {
        ctxDashboard.moveTo(point.x, point.y)
      } else {
        ctxDashboard.lineTo(point.x, point.y)
      }
    })

    ctxDashboard.stroke()

    // Add some grid lines
    ctxDashboard.strokeStyle = "#374151"
    ctxDashboard.lineWidth = 1

    // Horizontal lines
    for (let i = 0; i < 5; i++) {
      const y = (canvasDashboard.height / 5) * i
      ctxDashboard.beginPath()
      ctxDashboard.moveTo(0, y)
      ctxDashboard.lineTo(canvasDashboard.width, y)
      ctxDashboard.stroke()
    }

    // Vertical lines
    for (let i = 0; i < 7; i++) {
      const x = (canvasDashboard.width / 7) * i
      ctxDashboard.beginPath()
      ctxDashboard.moveTo(x, 0)
      ctxDashboard.lineTo(x, canvasDashboard.height)
      ctxDashboard.stroke()
    }
  }

  // Handle window resize for mobile sidebar
  window.addEventListener("resize", () => {
    if (window.innerWidth >= 768) {
      // On desktop, always hide mobile sidebar
      sidebar.classList.remove("show")
      sidebarOverlay.classList.remove("show")
    }
  })
})