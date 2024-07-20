<?php
session_start();
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/modules/Database.php';
require_once dirname(__DIR__) . '/controllers/ArticleController.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'SuperAdmin') {
    header("Location: /");
    exit();
}

$db = new Database();
$articleController = new ArticleController($db);

$limit = 9;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$articles = $articleController->getPaginatedArticles($limit, $offset);
$totalArticles = $articleController->getTotalArticleCount();
$totalPages = ceil($totalArticles / $limit);

$editingArticle = null;
if (isset($_GET['edit'])) {
    $editingArticle = $articleController->getArticleById($_GET['edit']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];
    $author = $_POST['author'];
    $id = $_POST['id'] ?? null;

    if ($id) {
        // Update
        $articleController->updateArticle($id, $title, $content, $image, $author);
    } else {
        // Create
        $articleController->createArticle($title, $content, $image, $author);
    }
    header("Location: manage_articles.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <title>Manage Articles - FK-PKPPS Ponpes</title>
    <?php include dirname(__DIR__) . '/parsial/meta.php';?>
    <script>
      function confirmDelete(articleId) {
        if (confirm("Are you sure you want to delete this article?")) {
          window.location.href = 'delete_article.php?id=' + articleId;
        }
      }

      function cancelEdit() {
        window.location.href = 'manage_articles.php';
      }

      function toggleContent(id) {
        const content = document.getElementById('content-' + id);
        const button = document.getElementById('toggle-' + id);
        if (content.classList.contains('shortened')) {
          content.classList.remove('shortened');
          button.textContent = 'Show Less';
        } else {
          content.classList.add('shortened');
          button.textContent = 'Show More';
        }
      }
    </script>
    <style>
      .shortened {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-height: 4.5em; /* Adjust based on your requirement */
      }
    </style>
</head>
<body>
    <?php include dirname(__DIR__) . '/parsial/navbar.php'; ?>
    <!-- ====== CTAStart -->
    <section class="relative z-10 overflow-hidden bg-primary py-20 lg:py-[115px]">
      <div class="container mx-auto">
        <div class="relative overflow-hidden">
          <div class="-mx-4 flex flex-wrap items-stretch">
            <div class="w-full px-4">
              <div class="mx-auto max-w-[570px] text-center">
                <h2 class="mb-2.5 text-3xl font-bold text-white md:text-[38px] md:leading-[1.44]">
                  <span>Kelola Artikel dan Berita</span><br>
                </h2>
                <p class="mx-auto mb-6 max-w-[515px] text-base leading-[1.5] text-white"> Anda dapat membuat atau mengedit artikel dan berita terkait kegiatan yang sedang atau akan berlangsung. </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <span class="absolute left-0 top-0">
          <svg width="495" height="470" viewBox="0 0 495 470" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="55" cy="442" r="138" stroke="white" stroke-opacity="0.04" stroke-width="50" />
            <circle cx="446" r="39" stroke="white" stroke-opacity="0.04" stroke-width="20" />
            <path d="M245.406 137.609L233.985 94.9852L276.609 106.406L245.406 137.609Z" stroke="white" stroke-opacity="0.08" stroke-width="12" />
          </svg>
        </span>
        <span class="absolute bottom-0 right-0">
          <svg width="493" height="470" viewBox="0 0 493 470" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="462" cy="5" r="138" stroke="white" stroke-opacity="0.04" stroke-width="50" />
            <circle cx="49" cy="470" r="39" stroke="white" stroke-opacity="0.04" stroke-width="20" />
            <path d="M222.393 226.701L272.808 213.192L259.299 263.607L222.393 226.701Z" stroke="white" stroke-opacity="0.06" stroke-width="13" />
          </svg>
        </span>
      </div>
    </section>
    <!-- ====== CTAEnd -->
    <section class="relative pb-20 md:pb-[120px] bg-primary h-full">
        <div class="container px-4">            
        <div class="w-full px-4">
            <div class="mx-auto text-left bg-primary">
                <h2 class="mb-2.5 text-3xl font-bold text-white dark:text-white md:text-[18px] md:leading-[1.44]">
                    <?php echo $editingArticle ? 'Edit Berita/Artikel' : 'Buat Berita/Artikel'; ?>
                </h2>
            </div>
        </div>
      <div>
        <span class="absolute left-0 top-0">
          <svg width="495" height="470" viewBox="0 0 495 470" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="55" cy="442" r="138" stroke="white" stroke-opacity="0.04" stroke-width="50" />
            <circle cx="446" r="39" stroke="white" stroke-opacity="0.04" stroke-width="20" />
            <path d="M245.406 137.609L233.985 94.9852L276.609 106.406L245.406 137.609Z" stroke="white" stroke-opacity="0.08" stroke-width="12" />
          </svg>
        </span>
        <span class="absolute bottom-0 right-0">
          <svg width="493" height="470" viewBox="0 0 493 470" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="462" cy="5" r="138" stroke="white" stroke-opacity="0.04" stroke-width="50" />
            <circle cx="49" cy="470" r="39" stroke="white" stroke-opacity="0.04" stroke-width="20" />
            <path d="M222.393 226.701L272.808 213.192L259.299 263.607L222.393 226.701Z" stroke="white" stroke-opacity="0.06" stroke-width="13" />
          </svg>
        </span>
      </div>
        <div class="w-full px-4">
            <div class="wow fadeInUp rounded-lg bg-transparent dark:bg-dark-2 py-10 px-8 dark:shadow-none sm:py-12 sm:px-10 md:p-[60px] lg:p-10 lg:py-12 lg:px-10 2xl:p-[60px]" data-wow-delay=".2s ">
            <form action="manage_articles.php" method="post" class="bg-white bordered shadow-md rounded-md p-4">
            <input type="hidden" name="id" value="<?php echo $editingArticle['id'] ?? ''; ?>">
                <div class="mb-[22px]">
                    <label for="title" class="block mb-4 text-sm text-body-color dark:text-dark-6">Judul:</label>
                    <input type="text" name="title" id="title" class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" value="<?php echo $editingArticle['title'] ?? ''; ?>" required/>
                </div>
                <div class="mb-[30px]">
                    <label for="content" class="block mb-4 text-sm text-body-color dark:text-dark-6">Konten:</label>
                    <textarea name="content" id="content" rows="6" class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 resize-none border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none"  required><?php echo $editingArticle['content'] ?? ''; ?></textarea>
                </div>
                <div class="mb-[22px]">
                    <label for="image" class="block mb-4 text-sm text-body-color dark:text-dark-6">URL Gambar:</label>
                    <input type="text" name="image" id="image" class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" value="<?php echo $editingArticle['image'] ?? ''; ?>" required/>
                </div>
                <div class="mb-[22px]">
                    <label for="author" class="block mb-4 text-sm text-body-color dark:text-dark-6">Nama Penulis</label>
                    <input type="text" name="author" id="author" class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" value="<?php echo $editingArticle['author'] ?? ''; ?>" required/>
                </div>
                <div class="mb-0">
                    <button type="submit" class="inline-flex items-center justify-center px-10 py-3 text-base font-medium text-white transition duration-300 ease-in-out rounded-md bg-primary hover:bg-blue-dark"><?php echo $editingArticle ? 'Perbarui' : 'Buat'; ?> Artikel/Berita </button>
                    <?php if ($editingArticle): ?>
                        <button type="button" onclick="cancelEdit()" class="inline-flex items-center justify-center px-10 py-3 text-base font-medium text-white transition duration-300 ease-in-out rounded-md bg-primary hover:bg-blue-dark">Batal</button>
                    <?php endif; ?>
                </div>
                </form>
            </div>
        </div>
        </div>
        </div>
    </section>
    <!-- ====== BlogStart -->
    <section class="pt-10 pb-10 lg:pb-20 dark:bg-dark py-20 lg:py-[120px] h-full">
      <div class="container">                   
      <div class="w-full px-4 pb-4">
            <div class="mx-auto text-left">
                <h2 class="mb-2.5 text-3xl font-bold text-dark dark:text-white md:text-[18px] md:leading-[1.44]">
                <span>Daftar Artikel/Berita Kegiatan<br>
                </h2>
            </div>
        </div>
        <div class="flex flex-wrap -mx-4">
            <?php foreach ($articles as $article): ?>
            <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                <div class="mb-10 wow fadeInUp group" data-wow-delay=".1s">
                    <div class="mb-8 overflow-hidden rounded-[5px]">
                        <a href="javascript:void(0)" class="block">
                        <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="w-full transition group-hover:rotate-6 group-hover:scale-125" />
                        </a>
                    </div>
                    <div>
                        <p class="inline-block px-4 py-0.5 mb-6 text-xs font-medium leading-loose text-center text-dark rounded-[5px]">Ditulis oleh: <?php echo htmlspecialchars($article['author']); ?> | <?php echo htmlspecialchars($article['created_at']); ?></p>
                        <h3>
                        <a href="blog-details.html" class="inline-block mb-4 text-xl font-semibold text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl"> <?php echo htmlspecialchars($article['title']); ?> </a>
                        </h3>
                        <p id="content-<?php echo $article['id']; ?>" class="max-w-[370px] py-10 text-base text-dark dark:text-dark-600 font-medium text-body-color shortened"> <?php echo htmlspecialchars_decode($article['content']); ?> </p>
                        <button id="toggle-<?php echo $article['id']; ?>" onclick="toggleContent(<?php echo $article['id']; ?>)" class="text-blue-500">Show More</button>
                    </div>
                </div>
                
                <a href="manage_articles.php?edit=<?php echo $article['id']; ?>" class="text-blue-500 bg-primary px-4 py-2 text-white rounded-md my-4">Ubah</a>
                <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $article['id']; ?>)" class="text-red-500 ml-2 bg-primary px-4 py-2 text-white rounded-md my-4">Hapus</a>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-8 text-center wow fadeInUp" data-wow-delay=".2s">
          <div class="inline-flex p-3 bg-white dark:bg-dark-2 border rounded-[10px] border-stroke dark:border-dark-3">
            <ul class="flex items-center -mx-1">
              <?php for ($i = 1; $i <= $totalPages; $i++): ?>
              <li class="px-1">
                <a href="manage_articles.php?page=<?php echo $i; ?>" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white"> <?php echo $i; ?> </a>
              </li>
              <?php endfor; ?>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== BlogEnd -->
    <?php include dirname(__DIR__) . '/parsial/footer.php'; ?>
    <a href="javascript:void(0)" class="back-to-top fixed bottom-8 left-auto right-8 z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark">
      <span class="mt-[6px] h-3 w-3 rotate-45 border-l border-t border-white"></span>
    </a>
    <script src="<?php echo ASSETS_URL; ?>js/swiper-bundle.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/main.js"></script>
</body>
</html>
