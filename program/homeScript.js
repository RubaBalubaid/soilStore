const images = document.querySelectorAll('.plantsAnchor img');

images.forEach((image) => {
  const content = image.dataset.content;
  const contentElement = document.createElement('div');
  contentElement.classList.add('content');
  image.parentNode.appendChild(contentElement);

    // Remove the data-content attribute from the image
    image.removeAttribute('data-content');
  });