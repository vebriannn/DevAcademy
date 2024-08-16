const url = 'https://www.aeee.in/wp-content/uploads/2020/08/Sample-pdf.pdf';

let pdfDoc = null,
    pageNum = 1,
    pageIsRendering = false,
    pageNumIsPending = null;

let scale = 1.0, // Default zoom scale
    canvas = document.querySelector('#pdf-render'),
    ctx = canvas.getContext('2d');

// Render the page
const renderPage = num => {
    pageIsRendering = true;

    pdfDoc.getPage(num).then(page => {
        const viewport = page.getViewport({ scale });
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        const renderCtx = {
            canvasContext: ctx,
            viewport
        };

        page.render(renderCtx).promise.then(() => {
            pageIsRendering = false;

            if (pageNumIsPending !== null) {
                renderPage(pageNumIsPending);
                pageNumIsPending = null;
            }
        });

        // Output current page
        document.querySelector('#page-num').textContent = num;
        document.querySelector('#page-input').value = num; // Update input field
    });
};

// Check for pages rendering
const queueRenderPage = num => {
    if (pageIsRendering) {
        pageNumIsPending = num;
    } else {
        renderPage(num);
    }
};

// Show Prev Page
const showPrevPage = () => {
    if (pageNum <= 1) {
        return;
    }
    pageNum--;
    queueRenderPage(pageNum);
    document.querySelector('#page-input').value = pageNum; // Update input field
};

// Show Next Page
const showNextPage = () => {
    if (pageNum >= pdfDoc.numPages) {
        return;
    }
    pageNum++;
    queueRenderPage(pageNum);
    document.querySelector('#page-input').value = pageNum; // Update input field
};

// Show Page by Input
const showPageByInput = () => {
    const inputPageNum = document.querySelector('#page-input').value;
    const pageNumber = parseInt(inputPageNum, 10);

    if (pageNumber >= 1 && pageNumber <= pdfDoc.numPages) {
        pageNum = pageNumber;
        queueRenderPage(pageNum);
    } else {
        document.querySelector('#page-input').value = pageNum; // Reset input if invalid
    }
};

// Zoom In
const zoomIn = () => {
    scale += 0.1; // Increase zoom level
    queueRenderPage(pageNum); // Re-render the current page
};

// Zoom Out
const zoomOut = () => {
    if (scale > 0.5) { // Prevent zooming out too much
        scale -= 0.1; // Decrease zoom level
        queueRenderPage(pageNum); // Re-render the current page
    }
};

// Fullscreen Functionality for the entire content container
const toggleFullscreen = () => {
    const contentContainer = document.querySelector('#ebook'); // Updated ID
    if (!document.fullscreenElement) {
        // Request fullscreen on the content container
        contentContainer.requestFullscreen().catch(err => {
            console.error(`Error attempting to enable full-screen mode: ${err.message}`);
        });
    } else {
        // Exit fullscreen
        if (document.exitFullscreen) {
            document.exitFullscreen();
        }
    }
};

// Handle Keyboard Events for Navigation
document.addEventListener('keydown', (event) => {
    switch (event.key) {
        case 'ArrowLeft':
            showPrevPage();
            break;
        case 'ArrowRight':
            showNextPage();
            break;
    }
});

// Get Document
pdfjsLib
    .getDocument(url)
    .promise.then(pdfDoc_ => {
        pdfDoc = pdfDoc_;
        document.querySelector('#page-count').textContent = pdfDoc.numPages;
        renderPage(pageNum);
        document.querySelector('#page-input').value = pageNum; // Initialize input field to the current page
    })
    .catch(err => {
        const div = document.createElement('div');
        div.className = 'error';
        div.appendChild(document.createTextNode(err.message));
        document.querySelector('body').insertBefore(div, canvas);
        document.querySelector('.top-bar').style.display = 'none';
    });

// Button Events
document.querySelector('#prev-page').addEventListener('click', showPrevPage);
document.querySelector('#next-page').addEventListener('click', showNextPage);
document.querySelector('#zoom-in').addEventListener('click', zoomIn);
document.querySelector('#zoom-out').addEventListener('click', zoomOut);
document.querySelector('#pdf-fullscreen').addEventListener('click', toggleFullscreen);
document.querySelector('#page-input').addEventListener('change', showPageByInput); // Add event listener for input change

// Initial Setup for Page Input
document.querySelector('#page-input').value = pageNum;
